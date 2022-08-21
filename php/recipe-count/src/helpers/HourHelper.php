<?php

namespace src\helpers;

use DateTimeImmutable;

class HourHelper
{
    public static function hour12ToHour24(string $hour12): int
    {
        // Format "h" = 12-hour integer
        // Format "a" = Ante meridiem and Post meridiem. "am" or "pm" in any case
        $dateTime = DateTimeImmutable::createFromFormat('ha', $hour12);

        // Format "H" - 24-hour integer
        return (int)$dateTime->format('H');
    }

    public static function hour24ToHour12(int $hour24): string
    {
        // Format "H" - 24-hour integer
        $dateTime = DateTimeImmutable::createFromFormat('H', $hour24);

        // Format "h" = 12-hour integer
        // Format "a" = Ante meridiem and Post meridiem. "am" or "pm" in any case
        return $dateTime->format('ha');
    }
}
