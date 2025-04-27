<?php
// File: customassets/dashboard/forecast_sales_hw.php
include 'cnndb.php';
header('Content-Type: application/json');

// 1. Fetch monthly total collections
$sql = "
  SELECT 
    YEAR(payment_date) AS yr,
    MONTH(payment_date) AS mo,
    SUM(amount_paid) AS total
  FROM collection
  GROUP BY yr, mo
  ORDER BY yr, mo
";
$res = $conn->query($sql);

$series = [];
while ($r = $res->fetch_assoc()) {
    $series[] = (float)$r['total'];
}
$conn->close();

// 2. Simple forecast fallback (average month-to-month growth)
function simpleForecast(array $data, int $horizon): array {
    $n = count($data);
    if ($n < 2) {
        // Kung isa lang o zero data points, ulit-ulit ang huling value
        return array_fill(0, $horizon, $n ? $data[$n - 1] : 0.0);
    }
    // Compute average growth
    $totalGrowth = 0.0;
    for ($i = 1; $i < $n; $i++) {
        $totalGrowth += ($data[$i] - $data[$i - 1]);
    }
    $avgGrowth = $totalGrowth / ($n - 1);
    // Build forecast
    $last = $data[$n - 1];
    $forecast = [];
    for ($m = 1; $m <= $horizon; $m++) {
        $forecast[] = round($last + $avgGrowth * $m, 2);
    }
    return $forecast;
}

// 3. Holt–Winters Triple Exponential Smoothing
function holtWinters(array $series, int $seasonLen, float $alpha, float $beta, float $gamma, int $horizon): array {
    $n = count($series);
    // Fallback kung hindi pa sapat ang data
    if ($n < $seasonLen) {
        return simpleForecast($series, $horizon);
    }
    // Initialize level & trend
    $level = array_sum(array_slice($series, 0, $seasonLen)) / $seasonLen;
    $trend = (
        array_sum(array_slice($series, $seasonLen, $seasonLen))
        - array_sum(array_slice($series, 0, $seasonLen))
    ) / ($seasonLen * $seasonLen);
    // Initialize seasonals
    $seasonals = [];
    for ($i = 0; $i < $seasonLen; $i++) {
        $seasonals[$i] = $series[$i] / $level;
    }
    // Smoothing loop
    for ($t = 0; $t < $n; $t++) {
        $lastLevel = $level;
        $lastTrend = $trend;
        $si = $t % $seasonLen;
        $level   = $alpha * ($series[$t] / $seasonals[$si]) + (1 - $alpha) * ($lastLevel + $lastTrend);
        $trend   = $beta  * ($level - $lastLevel) + (1 - $beta) * $lastTrend;
        $seasonals[$si] = $gamma * ($series[$t] / $level) + (1 - $gamma) * $seasonals[$si];
    }
    // Forecast next periods
    $forecast = [];
    for ($m = 1; $m <= $horizon; $m++) {
        $si = ($n + $m - 1) % $seasonLen;
        $forecast[] = round(($level + $m * $trend) * $seasonals[$si], 2);
    }
    return $forecast;
}

// 4. Run forecasting
$seasonLen = 12;
$alpha     = 0.2;
$beta      = 0.05;
$gamma     = 0.1;
$horizon   = 6;

// Pumili ng method: Holt–Winters with fallback
$forecast = holtWinters($series, $seasonLen, $alpha, $beta, $gamma, $horizon);

// 5. Build labels for next 6 months
$labels = [];
$now = new DateTime();
for ($i = 1; $i <= $horizon; $i++) {
    $now->modify('+1 month');
    $labels[] = $now->format('M Y');
}

// 6. Output JSON
echo json_encode([
    'labels'   => $labels,
    'history'  => $series,
    'forecast' => $forecast
]);
