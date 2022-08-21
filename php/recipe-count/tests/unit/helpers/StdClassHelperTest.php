<?php

namespace tests\unit\helpers;

use src\helpers\StdClassHelper;
use src\models\Order;
use stdClass;
use tests\unit\UnitTest;

class StdClassHelperTest extends UnitTest
{
    public function run(): void
    {
        $stdClass = new stdClass;
        $stdClass->postcode = '10208';
        $stdClass->recipe = 'Speedy Steak Fajitas';
        $stdClass->delivery = 'Thursday 7AM - 5PM';

        $object = new Order();

        $this->test($object->postcode, '');
        $this->test($object->recipe, '');
        $this->test($object->delivery, '');

        StdClassHelper::toObject($stdClass, $object);

        $this->test($stdClass->postcode, $object->postcode);
        $this->test($stdClass->recipe, $object->recipe);
        $this->test($stdClass->delivery, $object->delivery);
    }
}
