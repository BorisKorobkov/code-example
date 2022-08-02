<?php

use tests\unit\counters\CounterBusiestPostcodeTest;
use tests\unit\counters\CounterMatchByNameTest;
use tests\unit\counters\CounterPerPostcodeAndPerTimeTest;
use tests\unit\counters\CounterPerRecipeTest;
use tests\unit\counters\CounterUniqueRecipeTest;
use tests\unit\helpers\HourHelperTest;
use tests\unit\helpers\StdClassHelperTest;
use tests\unit\models\OrderTest;
use tests\unit\readers\ReaderJsonTest;

require_once __DIR__ . '/../../src/autoload.php';

$testClasses = [
    // helpers
    HourHelperTest::class,
    StdClassHelperTest::class,

    // models
    OrderTest::class,

    // counters
    CounterBusiestPostcodeTest::class,
    CounterMatchByNameTest::class,
    CounterPerPostcodeAndPerTimeTest::class,
    CounterPerRecipeTest::class,
    CounterUniqueRecipeTest::class,

    // readers
    ReaderJsonTest::class,
];

foreach ($testClasses as $testClass) {
    echo PHP_EOL . $testClass . ' ';
    (new $testClass)->run();
}
echo PHP_EOL;
