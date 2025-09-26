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

    public static function selectUser(string $username)
    {
        $sql = 'SELECT user_id, username, hashed_password, role, created_on FROM UserTable WHERE username = :username';
        $value = [':username' => $username];

        return Db::selectOne($sql, $value);
    }

    public static function selectUserById(string $user_id)
    {
        $sql = 'SELECT user_id, username, role, created_on FROM UserTable WHERE user_id = :user_id';
        $value = [':user_id' => $user_id];

        return Db::selectOne($sql, $value);
    }
}
