<?php

namespace blog\model;

use mvc\Db;
use RuntimeException;

class User
{
    public int $id;
    public string $login;
    public string $password;
    public string $email;
    public string $name;
    public string $street;
    public string $postcode;
    public string $place;

    /**
     * @param int $id
     * @return self|null
     * @throws RuntimeException
     */
    public static function getById(int $id): ?User
    {
        $connection = Db::getConnection();
        $result = $connection->query(sprintf('SELECT id, login, password, email, name, street, postcode, place FROM user WHERE id = %d', $id));
        if ($connection->error) {
            throw new RuntimeException('DB error ' . $connection->error);
        }

        if (!$result) {
            $result->close();
            return null;
        }

        $row = $result->fetch_object();
        $user = new self;
        $user->id = (int)$row->id;
        $user->login = (string)$row->login;
        $user->password = (string)$row->password;
        $user->email = (string)$row->email;
        $user->name = (string)$row->name;
        $user->street = (string)$row->street;
        $user->postcode = (string)$row->postcode;
        $user->place = (string)$row->place;

        return $user;
    }
}