<?php

namespace models;

use framework\Logger;
use RuntimeException;

class ReaderJson implements ReaderInterface
{
    public function read(string $input): OfferCollectionInterface
    {
        Logger::getInstance()->debug('ReaderJson: ' . $input);

        // "@" - suppress warning
        $response = @file_get_contents($input);
        if (!$response) {
            throw new RuntimeException('Wrong filename ' . $input);
        }

        // "@" - suppress warning
        $data = @json_decode($response, true);
        if (!is_array($data)) {
            throw new RuntimeException('Wrong JSON ' . $response);
        }

        return new OfferCollection($data['special_offers']);
    }
}