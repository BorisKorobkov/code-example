<?php

namespace framework;

use models\OfferCollection;
use models\ReaderInterface;

abstract class Controller
{
    protected string $filename;
    protected string $reader;

    public function __construct(string $filename, string $reader)
    {
        $this->filename = $filename;
        $this->reader = $reader;
    }

    abstract public function run(array $argv): int;

    protected function getOfferCollection(): OfferCollection
    {
        /** @var ReaderInterface $reader */
        $reader = new $this->reader();
        return $reader->read($this->filename);
    }
}