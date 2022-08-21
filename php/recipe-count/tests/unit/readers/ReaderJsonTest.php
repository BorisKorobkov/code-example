<?php

namespace tests\unit\readers;

use src\readers\ReaderJson;
use tests\unit\UnitTest;

class ReaderJsonTest extends UnitTest
{
    public function run(): void
    {
        $reader = new ReaderJson();
        $fileUrl = __DIR__ . '/../../fixtures/fixtures.json';
        $iterator = $reader->getIterator($fileUrl);
        $order = $iterator->current();
        $this->test($order, [
            'postcode' => '10224',
            'recipe' => 'Creamy Dill Chicken',
            'delivery' => 'Wednesday 1AM - 7PM',
        ]);
    }
}
