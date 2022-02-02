<?php

namespace framework;

use DateTimeInterface;
use Exception;

class Logger extends Singleton
{
    /**
     * @link https://github.com/Seldaek/monolog/blob/master/src/Monolog/Logger.php
     */
    const LOG_LEVEL_DEBUG = 100;
    const LOG_LEVEL_INFO = 200;
    const LOG_LEVEL_NOTICE = 250;
    const LOG_LEVEL_WARNING = 300;
    const LOG_LEVEL_ERROR = 400;
    const LOG_LEVEL_CRITICAL = 500;
    const LOG_LEVEL_ALERT = 550;
    const LOG_LEVEL_EMERGENCY = 600;

    private int $minLogLevel = 250;

    private $fileHandle;

    // "protected" prevents initiation with outer code
    protected function __construct($fileName = null, $logLevel = self::LOG_LEVEL_INFO)
    {
        if (!$fileName) {
            $fileName = __DIR__ . '/../runtime/' . date('Y-m-d') . '.log';
        }
        $this->fileHandle = @fopen($fileName, 'a');

        $this->minLogLevel = $logLevel;

        parent::__construct();
    }

    private function write(string $message, int $logLevel): void
    {
        if (!$this->fileHandle) {
            // The log-file isn't writable, but "The Show Must Go On"
            return;
        }

        if ($logLevel < $this->minLogLevel) {
            // We are not interested in this
            return;
        }

        // Later it's easier to parse log-file without new lines
        $message = strtr($message, [
            "\r" => ' ',
            "\n" => ' ',
        ]);

        fwrite($this->fileHandle, date(DateTimeInterface::W3C) . ' ' . $logLevel . ' ' . $message . PHP_EOL);
    }

    public function debug(string $message): void
    {
        $this->write($message, self::LOG_LEVEL_DEBUG);
    }

    public function info(string $message): void
    {
        $this->write($message, self::LOG_LEVEL_INFO);
    }

    public function notice(string $message): void
    {
        $this->write($message, self::LOG_LEVEL_NOTICE);
    }

    public function warning(string $message): void
    {
        $this->write($message, self::LOG_LEVEL_WARNING);
    }

    public function error(string $message): void
    {
        $this->write($message, self::LOG_LEVEL_ERROR);
    }

    public function critical(string $message): void
    {
        $this->write($message, self::LOG_LEVEL_CRITICAL);
    }

    public function alert(string $message): void
    {
        $this->write($message, self::LOG_LEVEL_ALERT);
    }

    public function emergency(string $message): void
    {
        $this->write($message, self::LOG_LEVEL_EMERGENCY);
    }

    public function exception(Exception $e): void
    {
        global $argv;
        $message = $e->getMessage() . ' ' . print_r($argv, true) . ' ' . $e->getTraceAsString();
        $this->write($message, self::LOG_LEVEL_ERROR);
    }


}