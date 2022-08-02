<?php

namespace blog\model;

use DateTime;
use Exception;
use mvc\Config;
use mvc\Db;
use RuntimeException;

class Entry
{
    public int $id;
    public int $userId;
    public string $title;
    public string $text;
    public string $datetime;

    /**
     * @param int $id
     * @return self|null
     * @throws RuntimeException
     */
    public static function getById(int $id): ?Entry
    {
        if (!$id) {
            return null;
        }

        $connection = Db::getConnection();
        $result = $connection->query(sprintf('SELECT id, user_id, title, text, datetime FROM entry WHERE id = %d', $id));
        if ($connection->error) {
            throw new RuntimeException('DB error ' . $connection->error);
        }

        if (!$result) {
            $result->close();
            return null;
        }

        $row = $result->fetch_object();
        $entry = new self;
        $entry->id = (int)$row->id;
        $entry->userId = (int)$row->user_id;
        $entry->title = (string)$row->title;
        $entry->text = (string)$row->text;
        $entry->datetime = (string)$row->datetime;

        return $entry;
    }

    /**
     * @param int $limit
     * @return self[]
     * @throws RuntimeException
     */
    public static function getLastEntries(int $limit = 3): array
    {
        $connection = Db::getConnection();
        $result = $connection->query(sprintf('SELECT id, user_id, title, text, datetime FROM entry ORDER BY datetime DESC LIMIT %d', $limit));
        if ($connection->error) {
            throw new RuntimeException('DB error ' . $connection->error);
        }

        if (!$result) {
            $result->close();
            return [];
        }

        $entries = [];
        while ($row = $result->fetch_object()) {
            $entry = new self;
            $entry->id = (int)$row->id;
            $entry->userId = (int)$row->user_id;
            $entry->title = (string)$row->title;
            $entry->text = (string)$row->text;
            $entry->datetime = (string)$row->datetime;
            $entries[] = $entry;
        }

        return $entries;
    }

    /**
     * @return User|null
     * @throws RuntimeException
     */
    public function getUser(): ?User
    {
        if (!$this->userId) {
            return null;
        }

        return User::getById($this->userId);
    }

    /**
     * @return Comment[]
     * @throws RuntimeException
     */
    public function getComments(): array
    {
        return Comment::getByEntryId($this->id);
    }

    /**
     * @param string $dateFormat
     * @return string
     * @throws Exception
     */
    public function getFormattedDate(string $dateFormat = 'd.m.Y'): string
    {
        $dateTimeNow = new DateTime();
        $dateTimeEntry = new DateTime($this->datetime);

        $entryDateTimeFormatted = $dateTimeEntry->format($dateFormat);
        if ($entryDateTimeFormatted == $dateTimeNow->format($dateFormat)) {
            return 'Today';
        }

        return $entryDateTimeFormatted;
    }

    /**
     * @param int $limit
     * @return string
     */
    public function getTextPreview(int $limit = 1000): string
    {
        if (mb_strlen($this->text) < $limit) {
            return $this->text;
        }

        return mb_substr($this->text, 0, $limit) . '…';
    }

    /**
     * @return string
     */
    public function getDetailUrl(): string
    {
        if (Config::$config['isSemanticUrl']) {
            $url = '/blog/entry/?';
        } else {
            $url = '/?controller=blog&action=entry&';
        }

        return $url . 'id=' . $this->id;
    }
}