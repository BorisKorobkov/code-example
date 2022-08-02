<?php

use src\counters\CounterBusiestPostcode;
use src\counters\CounterInterface;
use src\counters\CounterMatchByName;
use src\counters\CounterPerPostcodeAndPerTime;
use src\counters\CounterPerRecipe;
use src\counters\CounterUniqueRecipe;
use src\models\Order;
use src\readers\ReaderJson;

require_once __DIR__ . '/autoload.php';

/**
 * Get ENV-variables
 */
// HTTP URL or local path to a file with fixtures. Supported formats: .json, .json.gz, .json.tar.gz
$filePath = $_ENV['FILE_PATH'] ?? 'tests/fixtures/fixtures.json.tar.gz';

$counterPerPostcode = $_ENV['COUNTER_PER_POSTCODE'] ?? '10120';
$counterPerTime12From = $_ENV['COUNTER_PER_TIME12FROM'] ?? '10AM';
$counterPerTime12To = $_ENV['COUNTER_PER_TIME12TO'] ?? '3PM';

$counterMatchByNameWords = $_ENV['COUNTER_MATCH_BY_NAME'] ?? 'Potato, Veggie, Mushroom';
$counterMatchByNameDelimiter = $_ENV['COUNTER_MATCH_BY_NAME_DELIMITER'] ?? ',';

/**
 * Counters for the response
 * @var CounterInterface[] $counters
 */
$counters = [
    new CounterUniqueRecipe(),
    new CounterPerRecipe(),
    new CounterBusiestPostcode(),
    new CounterPerPostcodeAndPerTime($counterPerPostcode, $counterPerTime12From, $counterPerTime12To),
    new CounterMatchByName($counterMatchByNameWords, $counterMatchByNameDelimiter),
];

/**
 * Parse the file and iterate all Orders
 */
$reader = new ReaderJson();
$iterator = $reader->getIterator($filePath);
foreach ($iterator as $orderData) {
    $order = new Order($orderData);
    // update counters
    foreach ($counters as $counter) {
        $counter->handleOrder($order);
    }
}

/**
 * Output JSON with counters
 */
$result = [];
foreach ($counters as $counter) {
    $result[$counter::getId()] = $counter->getResult();
}
echo json_encode($result, JSON_PRETTY_PRINT) . PHP_EOL;
