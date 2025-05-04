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
$history_labels = [];
while ($r = $res->fetch_assoc()) {
    $series[] = (float)$r['total'];
    $history_labels[] = DateTime::createFromFormat('!Y-n', "{$r['yr']}-{$r['mo']}")->format('M Y');
}
$conn->close();

// 2. Simple forecast fallback
function simpleForecast(array $data, int $horizon): array {
    $n = count($data);
    if ($n < 2) {
        return array_fill(0, $horizon, $n ? $data[$n - 1] : 0.0);
    }
    $totalGrowth = 0.0;
    for ($i = 1; $i < $n; $i++) {
        $totalGrowth += ($data[$i] - $data[$i - 1]);
    }
    $avgGrowth = $totalGrowth / ($n - 1);
    $last = $data[$n - 1];
    $forecast = [];
    for ($m = 1; $m <= $horizon; $m++) {
        $forecast[] = round(max($last + $avgGrowth * $m, 0.0), 2);
    }
    return $forecast;
}

// 3. Holt–Winters with error handling
function holtWinters(array $series, int $seasonLen, float $alpha, float $beta, float $gamma, int $horizon): array {
    $n = count($series);
    if ($n < $seasonLen) {
        return simpleForecast($series, $horizon);
    }

    $level = array_sum(array_slice($series, 0, $seasonLen)) / $seasonLen;
    $trend = (
        array_sum(array_slice($series, $seasonLen, $seasonLen))
        - array_sum(array_slice($series, 0, $seasonLen))
    ) / ($seasonLen * $seasonLen);

    $seasonals = [];
    for ($i = 0; $i < $seasonLen; $i++) {
        $seasonals[$i] = $series[$i] / ($level ?: 0.00001); // avoid divide by zero
    }

    for ($t = 0; $t < $n; $t++) {
        $lastLevel = $level;
        $lastTrend = $trend;
        $si = $t % $seasonLen;
        $seasonal = $seasonals[$si] ?: 0.00001;
        $level = $alpha * ($series[$t] / $seasonal) + (1 - $alpha) * ($lastLevel + $lastTrend);
        $trend = $beta * ($level - $lastLevel) + (1 - $beta) * $lastTrend;
        $seasonals[$si] = $gamma * ($series[$t] / ($level ?: 0.00001)) + (1 - $gamma) * $seasonals[$si];
    }

    $forecast = [];
    for ($m = 1; $m <= $horizon; $m++) {
        $si = ($n + $m - 1) % $seasonLen;
        $value = ($level + $m * $trend) * ($seasonals[$si] ?: 1);
        $forecast[] = round(max($value, 0.0), 2);
    }
    return $forecast;
}

// 4. Forecast Settings
$seasonLen = 12;
$alpha     = 0.2;
$beta      = 0.05;
$gamma     = 0.1;
$horizon   = 6;

$forecast = holtWinters($series, $seasonLen, $alpha, $beta, $gamma, $horizon);

// 5. Forecast Labels
$forecast_labels = [];
$now = new DateTime();
$now->modify('first day of next month');
for ($i = 0; $i < $horizon; $i++) {
    $forecast_labels[] = $now->format('M Y');
    $now->modify('+1 month');
}

// 6. Combined output for table or advanced charting
$combined = [];
foreach ($series as $i => $val) {
    $combined[] = [
        'label' => $history_labels[$i],
        'value' => $val,
        'type'  => 'history'
    ];
}
foreach ($forecast as $i => $val) {
    $combined[] = [
        'label' => $forecast_labels[$i],
        'value' => $val,
        'type'  => 'forecast'
    ];
}
// 8. Optional summary for UI
$totalForecast = array_sum($forecast);
$last6 = array_slice($series, -6);
$totalHistory = array_sum($last6);
$growth = $totalHistory > 0 ? (($totalForecast - $totalHistory) / $totalHistory) * 100 : 0;

$summaryText = sprintf(
    "Next %d months forecast: ₱%.2f total. %s%.1f%% vs previous 6 months.",
    $horizon,
    $totalForecast,
    $growth >= 0 ? "↑" : "↓",
    abs($growth)
);

// 9. Output JSON
echo json_encode([
    'labels'   => array_merge($history_labels, $forecast_labels),
    'history'  => $series,
    'forecast' => $forecast,
    'combined' => $combined,
    'summary'  => $summaryText // ← ito ang kailangan sa frontend
]);

