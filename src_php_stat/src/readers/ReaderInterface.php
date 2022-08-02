<?php

namespace src\readers;

use Iterator;

interface ReaderInterface
{
    public function getIterator(string $fileUrl): Iterator;
}
