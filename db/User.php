<?php

require_once 'db.php';

abstract class User
{
    public static function addUser(string $username, string $hashed_password)
    {
        $sql = 'INSERT INTO UserTable (username, hashed_password)
                VALUES (:username, :hashed_password)';
        $values = [':username' => $username, ':hashed_password' => $hashed_password];

        Db::query($sql, $values);
    }

    public static function getUser(string $username)
    {
        $sql = 'SELECT * FROM UserTable WHERE username = :username';
        $value = [':username' => $username];

        return Db::selectOne($sql, $value);
    }
}
