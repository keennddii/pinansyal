<?php
// File: customassets/dashboard/forecasting.php
include 'cnndb.php';

// Query to get historical disbursements data (same as before)
$sql = "
  SELECT disbursement_date, amount_paid 
  FROM disbursement
  ORDER BY disbursement_date ASC
";
$res = $conn->query($sql);

// Prepare arrays for historical data
$dataX = [];
$dataY = [];

while ($row = $res->fetch_assoc()) {
    $monthIndex = date('n', strtotime($row['disbursement_date']));
    $dataX[] = $monthIndex;
    $dataY[] = (float)$row['amount_paid'];
}

// Linear Regression Function
function linearRegression($dataX, $dataY) {
    $n = count($dataX);
    $sumX = array_sum($dataX);
    $sumY = array_sum($dataY);
    $sumXY = 0;
    $sumX2 = 0;

    // Calculate the sums for the formula
    for ($i = 0; $i < $n; $i++) {
        $sumXY += $dataX[$i] * $dataY[$i];
        $sumX2 += $dataX[$i] * $dataX[$i];
    }

    // Calculate the denominator for the slope (m)
    $denominator = ($n * $sumX2 - $sumX * $sumX);

    // Check if denominator is 0 to prevent division by zero
    if ($denominator == 0) {
        // Handle the case when denominator is 0 (e.g., not enough data or no variation in data)
        return [0, 0]; // Return default values, you can choose how you want to handle it
    }

    // Calculate slope (m) and intercept (b)
    $m = ($n * $sumXY - $sumX * $sumY) / $denominator;
    $b = ($sumY - $m * $sumX) / $n;

    return [$m, $b];
}


// Calculate the slope (m) and intercept (b)
list($m, $b) = linearRegression($dataX, $dataY);

// Forecast next month's value (for example, month 6)
$forecast = $m * 6 + $b;

// Return the forecasted value as JSON
echo json_encode([
  'predictedDisbursement' => round($forecast, 2)
]);

$conn->close();
