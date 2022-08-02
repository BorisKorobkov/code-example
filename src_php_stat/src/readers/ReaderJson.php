<?php

namespace src\readers;

use Iterator;
use RuntimeException;

/**
 * Parse .json file (.json, .json.gz, .json.tar.gz, etc.)
 */
class ReaderJson implements ReaderInterface
{
    public function getIterator(string $fileUrl): Iterator
    {
        // It's easier to use file_get_contents() + json_decode(), but it reads all data into the memory. The application can fall down.
        // So, we should read the file line-by-line and parse it ASAP.
        // It makes some restrictions to this JSON-file: each key-value and each bracket has to be in a new line.

        $jsonString = '';
        $handle = gzopen($fileUrl, 'r');
        if (!$handle) {
            throw new RuntimeException('Error reading file ' . $fileUrl);
        }

        while (!feof($handle)) {
            $buffer = fgets($handle, 4096);
            $buffer = trim($buffer); // remove \n

            if ($buffer === '{') {
                // start a new JSON entry
                $jsonString = $buffer;
                continue;
            }

            if ($buffer === '}' || $buffer === '},') {
                // finish the JSON entry
                $jsonString .= '}';
                yield @json_decode($jsonString);
            }

            // continue to read JSON entry
            $jsonString .= $buffer;
        }

        // Now $jsonString has tailings. It's not JSON, so we don't need it and don't yield Order
        gzclose($handle);
    }
}
