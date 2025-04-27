<?php
// File: customassets/dashboard/forecast_sales.php
include 'cnndb.php';
header('Content-Type: application/json');

// 1. Kuhanin yung monthly collections
$sql = "
    SELECT 
        YEAR(payment_date) AS year,
        MONTH(payment_date) AS month,
        SUM(amount_paid) AS total_collection
    FROM collection
    GROUP BY YEAR(payment_date), MONTH(payment_date)
    ORDER BY YEAR(payment_date), MONTH(payment_date)
";
$res = $conn->query($sql);

$months = [];
$sales = [];

while ($row = $res->fetch_assoc()) {
    $months[] = ($row['year'] * 12) + $row['month']; // unique value per month
    $sales[]  = (float)$row['total_collection'];
}

$conn->close();

// 2. Linear Regression Function
function linearRegression($x, $y) {
    $n = count($x);
    if ($n == 0) return [0, 0];

    $sumX = array_sum($x);
    $sumY = array_sum($y);
    $sumXY = 0;
    $sumXX = 0;

    for ($i = 0; $i < $n; $i++) {
        $sumXY += $x[$i] * $y[$i];
        $sumXX += $x[$i] * $x[$i];
    }

    $slope = ($n * $sumXY - $sumX * $sumY) / ($n * $sumXX - $sumX * $sumX);
    $intercept = ($sumY - $slope * $sumX) / $n;

    return [$slope, $intercept];
}

// 3. Predict future sales for the next 6 months
list($slope, $intercept) = linearRegression($months, $sales);

$lastMonth = end($months);

$forecast = [];
$monthNames = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec'];

// Define peak months
$peakMonths = [3, 4, 12]; // March, April, December

for ($i = 1; $i <= 6; $i++) {
    $futureMonthNum = $lastMonth + $i;
    $year = intdiv($futureMonthNum, 12);
    $month = $futureMonthNum % 12;
    if ($month == 0) {
        $month = 12;
        $year -= 1;
    }

    $basicPrediction = $slope * $futureMonthNum + $intercept;

    // Apply +30% boost kung peak month
    if (in_array($month, $peakMonths)) {
        $prediction = $basicPrediction * 1.3;
    } else {
        $prediction = $basicPrediction;
    }

    $forecast[] = [
        'month' => $monthNames[$month] . ' ' . $year,
        'predicted_sales' => round($prediction, 2)
    ];
}

// 4. Output JSON
echo json_encode($forecast);
?>
