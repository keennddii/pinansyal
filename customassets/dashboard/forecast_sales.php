<?php
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

// 3. Holt–Winters with fallback
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
        $seasonals[$i] = $series[$i] / ($level ?: 0.00001);
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
$lastHistoryDate = DateTime::createFromFormat('M Y', end($history_labels));
$lastHistoryDate->modify('+1 month');

$forecast_labels = [];
$nextMonth = clone $lastHistoryDate;
for ($i = 0; $i < $horizon; $i++) {
    $forecast_labels[] = $nextMonth->format('M Y');
    $nextMonth->modify('+1 month');
}

// 6. Seasonality Adjustment
$monthFactors = [
    'Jan' => 1.2, 'Feb' => 1.1, 'Mar' => 1.0,
    'Apr' => 1.2, 'May' => 1.3, 'Jun' => 0.9,
    'Jul' => 0.8, 'Aug' => 0.85, 'Sep' => 0.95,
    'Oct' => 1.0, 'Nov' => 1.1, 'Dec' => 1.5
];

$combined = [];
foreach ($series as $i => $val) {
    $combined[] = [
        'label' => $history_labels[$i],
        'value' => $val,
        'type'  => 'history'
    ];
}
foreach ($forecast as $i => $val) {
    $monthStr = substr($forecast_labels[$i], 0, 3);
    $adjustedVal = round($val * ($monthFactors[$monthStr] ?? 1), 2);
    $forecast[$i] = $adjustedVal;
    $combined[] = [
        'label' => $forecast_labels[$i],
        'value' => $adjustedVal,
        'type'  => 'forecast'
    ];
}

// 7. Summary
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

// 10. Enhanced AI Suggestion Logic (Professional English)
function getAISuggestion(array $series, array $forecast, array $forecast_labels, float $growth): string {
    $lastMonthValue = end($series);
    $nextMonthForecast = $forecast[0] ?? 0;
    $changeNextMonth = $lastMonthValue > 0 ? (($nextMonthForecast - $lastMonthValue) / $lastMonthValue) * 100 : 0;

    $firstMonth = substr($forecast_labels[0], 0, 3);
    $peakMonths = ['Apr', 'May', 'Dec'];
    $offMonths = ['Jul', 'Aug'];

    // Seasonal remark
    $seasonRemark = '';
    if (in_array($firstMonth, $peakMonths)) {
        $seasonRemark = "📆 The forecast begins during a **peak season** (**{$forecast_labels[0]}**), which historically drives higher revenue.";
    } elseif (in_array($firstMonth, $offMonths)) {
        $seasonRemark = "📉 The forecast starts in a **low-demand season** (**{$forecast_labels[0]}**), so slight drops may be expected.";
    }

    // Monthly spike/drop remark
    $monthlyRemark = '';
    if ($changeNextMonth >= 25) {
        $monthlyRemark = "🔥 **Next month shows a sharp increase of " . round($changeNextMonth, 1) . "%** compared to the most recent month.";
    } elseif ($changeNextMonth <= -20) {
        $monthlyRemark = "⚠️ **Next month shows a steep drop of " . round(abs($changeNextMonth), 1) . "%**, which may require immediate attention.";
    } elseif ($changeNextMonth >= 10) {
        $monthlyRemark = "📈 A noticeable **month-over-month growth** of " . round($changeNextMonth, 1) . "% is expected.";
    } elseif ($changeNextMonth <= -10) {
        $monthlyRemark = "📉 A noticeable **month-over-month decline** of " . round(abs($changeNextMonth), 1) . "% is forecasted.";
    }

    // Growth trend summary
    $trendDirection = $growth >= 0 ? "increase" : "decline";
    $growthIntensity = abs($growth);
    if ($growthIntensity >= 40) {
        $coreInsight = "🚀 A significant **$trendDirection of approximately " . round($growthIntensity, 1) . "%** is projected for the next 6 months.";
        $recommendation = "Maximize this momentum with aggressive campaigns, expanded offerings, and team scaling.";
    } elseif ($growthIntensity >= 20) {
        $coreInsight = "📈 A strong **$trendDirection of around " . round($growthIntensity, 1) . "%** is expected.";
        $recommendation = "Capitalize on this with marketing aligned to strong months and customer acquisition.";
    } elseif ($growthIntensity >= 10) {
        $coreInsight = "📊 A moderate **$trendDirection of " . round($growthIntensity, 1) . "%** is forecasted.";
        $recommendation = "Optimize operations and customer experience. This could be a good time to test new offers.";
    } elseif ($growthIntensity >= 3) {
        $coreInsight = "🔍 A mild **$trendDirection** of about " . round($growthIntensity, 1) . "% is seen.";
        $recommendation = "Maintain stability while observing for potential shifts in customer behavior.";
    } elseif ($growth < 0) {
        $coreInsight = "⚠️ A decline of " . round($growthIntensity, 1) . "% is forecasted compared to the last 6 months.";
        $recommendation = "Reassess pricing, improve peak-offer timing, and explore demand stimulation strategies.";
    } else {
        $coreInsight = "⏸️ A stable trend is projected, with minimal variation.";
        $recommendation = "Perfect for internal upgrades, client surveys, and service innovation.";
    }

    


    // Final formatted return with HTML-safe line breaks
    return "$monthlyRemark<br>$coreInsight<br>💡<strong>AI Recommendation:</strong> $recommendation";
}



// Call AI Suggestion
$aiSuggestion = getAISuggestion($series, $forecast, $forecast_labels, $growth);


// 9. Output (Final and Valid JSON)
echo json_encode([
    'labels'      => array_merge($history_labels, $forecast_labels),
    'history'     => $series,
    'forecast'    => $forecast,
    'combined'    => $combined,
    'summary'     => $summaryText,
    'ai_insight'  => $aiSuggestion
]);

