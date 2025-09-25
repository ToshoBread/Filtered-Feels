<?php

require 'db.php';

abstract class Post
{
    public static function addPost(string $title, string $content, string $signature, ?string $header_image = null)
    {
        $sql = 'INSERT INTO PostTable (title, content, header_image, signature)
                VALUES (:title, :content, :header_image, :signature)';
        $values = [
            ':title' => $title,
            ':content' => $content,
            ':header_image' => $header_image,
            ':signature' => $signature,
        ];

        Db::query($sql, $values);
    }

    public static function addPostWithUserId(string $title, string $content, string $signature, int $user_id, ?string $header_image = null)
    {
        $sql = 'INSERT INTO PostTable (title, content, header_image, signature, user_id)
                VALUES (:title, :content, :header_image, :signature, :user_id)';
        $values = [
            ':title' => $title,
            ':content' => $content,
            ':header_image' => $header_image,
            ':signature' => $signature,
            ':user_id' => $user_id,
        ];

        Db::query($sql, $values);
    }

    public static function selectAllPosts()
    {
        $sql = 'SELECT post_id, title, content, header_image, signature FROM PostTable';

        return Db::select($sql);
    }

    public static function selectPostByUserId(int $user_id)
    {
        $sql = 'SELECT * FROM PostTable WHERE user_id = :user_id';
        $value = [':user_id' => $user_id];

        return Db::select($sql, $value);
    }

    public static function selectPostByPostId(int $post_id)
    {
        $sql = 'SELECT * FROM PostTable WHERE post_id = :post_id';
        $value = [':post_id' => $post_id];

        return Db::selectOne($sql, $value);
    }
}
