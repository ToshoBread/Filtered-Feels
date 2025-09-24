<?php

require_once 'db.php';

abstract class User
{
    public static function getUser(string $username)
    {
        $sql = 'SELECT * FROM UserTable WHERE username = :username';
        $value = [':username' => $username];

        return Db::selectOne($sql, $value);
    }
}
