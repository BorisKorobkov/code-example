<?php

namespace tests\unit\helpers;

use src\helpers\HourHelper;
use tests\unit\UnitTest;

class HourHelperTest extends UnitTest
{
    private array $hours = [
        0 => '12AM',
        1 => '1AM',
        // ...
        11 => '11AM',
        12 => '12PM',
        13 => '1PM',
        // ...
        23 => '11PM',
    ];

    public function run(): void
    {
        foreach ($this->hours as $hour24 => $hour12) {
            $this->test(HourHelper::hour12ToHour24($hour12), $hour24);
        }
    }
}
