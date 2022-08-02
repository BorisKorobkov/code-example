<?php

namespace tests\unit;

use RuntimeException;

abstract class UnitTest
{
    abstract public function run(): void;

    protected function test(mixed $current, mixed $expected): void
    {
        if (!is_scalar($current)) {
            $current = json_encode($current);
        }

        if (!is_scalar($expected)) {
            $expected = json_encode($expected);
        }

        if ($current === $expected) {
            echo '+ ';
            return;
        }

        $errorMessage = sprintf('UnitTest fails. Current value: %s. Expected value: %s', $current, $expected);
        throw new RuntimeException($errorMessage);
    }
}
