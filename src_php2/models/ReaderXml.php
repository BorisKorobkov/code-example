<?php

namespace models;

use framework\Logger;
use RuntimeException;

class ReaderXml implements ReaderInterface
{
    public function read(string $input): OfferCollectionInterface
    {
        Logger::getInstance()->debug('ReaderXml: ' . $input);

        // "@" - suppress warning
        $response = @file_get_contents($input);
        if (!$response) {
            throw new RuntimeException('Wrong filename ' . $input);
        }

        // "@" - suppress warning
        $xml = @simplexml_load_string($response);
        if (!$xml) {
            throw new RuntimeException('Wrong XML ' . $xml);
        }

        // convert XML to JSON and then to an array
        $data = @json_decode(json_encode($xml), true);
        $data = $data['offer'] ?? null; // XML doesn't support a root array
        if (!is_array($data)) {
            throw new RuntimeException('Wrong JSON');
        }

        return new OfferCollection($data);
    }
}