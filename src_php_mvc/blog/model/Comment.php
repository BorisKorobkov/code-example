<?php

namespace blog\model;

use DateTime;
use Exception;
use mvc\Db;
use RuntimeException;

class Comment
{
    public int $id;
    public int $entry_id;
    public string $name;
    public string $email;
    public string $url;
    public string $remark;
    public string $datetime;

    /**
     * @return self[]
     * @throws RuntimeException
     */
    public static function getByEntryId(int $entryId): array
    {
        $connection = Db::getConnection();
        $result = $connection->query(sprintf('SELECT id, name, email, url, remark, datetime FROM comment WHERE entry_id = %d ORDER BY datetime ASC', $entryId));
        if ($connection->error) {
            throw new RuntimeException('DB error ' . $connection->error);
        }

        if (!$result) {
            $result->close();
            return [];
        }

        $comments = [];
        while ($row = $result->fetch_object()) {
            $comment = new self;
            $comment->id = (int)$row->id;
            $comment->entry_id = $entryId;
            $comment->name = (string)$row->name;
            $comment->email = (string)$row->email;
            $comment->url = (string)$row->url;
            $comment->remark = (string)$row->remark;
            $comment->datetime = (string)$row->datetime;
            $comments[] = $comment;
        }

        return $comments;
    }

    /**
     * @throws Exception
     */
    public function getFormattedDateTime(string $dateFormat = 'd.m.Y H:i'): string
    {
        $dateTime = new DateTime($this->datetime);

        return $dateTime->format($dateFormat);
    }
}