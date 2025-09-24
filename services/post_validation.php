<?php

include_once '../db/Post.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST['title']);
    $signature = htmlspecialchars($_POST['signature'] ?? 'Someone');
    $postContent = htmlspecialchars($_POST['post-content']);

    try {
        if (! empty($_FILES['header-img']['name'])) {
            $file = $_FILES['header-img'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('File error '.$file['error']);
            }

            $uploadDest = '../db/uploads/';

            if (! is_dir($uploadDest) && ! mkdir($uploadDest, 0755, true) && ! is_dir($uploadDest)) {
                throw new Exception('Failed to create directory');
            }

            $sanitizedName = preg_replace('/[^a-zA-Z0-9._-]/', '', basename($file['name']));
            $fileName = uniqid().'-'.$sanitizedName;
            $validFormats = ['jpg', 'jpeg', 'png'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (! getimagesize($file['tmp_name'])) {
                throw new Exception('Invalid Image!');
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            $validMimeTypes = ['image/jpeg', 'image/png'];

            if (! in_array($mimeType, $validMimeTypes)) {
                throw new Exception('Invalid MIME Type: '.$mimeType);
            }

            if (! in_array($fileExt, $validFormats)) {
                throw new Exception('Invalid File Format: '.$fileExt);
            }

            if (! move_uploaded_file($file['tmp_name'], $uploadDest.$fileName)) {
                throw new Exception('Failed to upload Image.');
            }

        }
    } catch (Exception $e) {
        error_log('File Upload Error: '.$e->getMessage()."\n", 3, __DIR__.'/../log.txt');
        header('Location: ../pages/new_post.php');
        exit();
    }
}

// TODO: Upload post to database
// Post::addPost($title, $postContent, $signature, $fileName);
