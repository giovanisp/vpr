var points = [
<?php
$history = $newVotesPerMinute;

$entries = array();
$current = 0;
$delta = 0;
$total = count($history);
foreach ($history as $entry) {
    if (count($entries) == $total - 5) {
        break;
    }
    $delta = $entry['new_votes'];
    
    $current += $delta;
    $date = DateTime::createFromFormat('Y-m-d H:i', $entry['time']);
    $month = $date->format('m') - 1;
    $year = $date->format('Y');
    $dateFormated = "$year, $month, " . $date->format('d, H, i, s');
    $entries[] = "[new Date($dateFormated), $delta]";
    $lastUpdate = $date->format('H:i');
}

echo implode(",\n", $entries);
?>
];
var current = <?= $current ?>;
var lastUpdate = '<?= $lastUpdate ?>';
var lastDelta = <?= $delta ?>;
var cacheHit = <?= $cacheHit?'true':'false' ?>;