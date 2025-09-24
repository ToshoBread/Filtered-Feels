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

    public static function selectAllPosts()
    {
        $sql = 'SELECT title, content, header_image, signature FROM PostTable';

        return Db::select($sql);
    }

    public static function getPostByUserId(int $user_id)
    {
        $sql = 'SELECT * FROM PostTable WHERE post_id = :post_id';
        $value = [':user_id' => $user_id];

        return Db::selectOne($sql, $value);
    }

    public static function getPostByPostId(int $post_id)
    {
        $sql = 'SELECT * FROM PostTable WHERE post_id = :post_id';
        $value = [':post_id' => $post_id];

        return Db::selectOne($sql, $value);
    }
}
