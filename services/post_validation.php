<?php

include_once '../db/Post.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Incorrect Request Method');
    }

    if (! isset($_POST['submit'])) {
        throw new Exception('Form Submission Error');
    }
} catch (Exception $e) {
    error_log(date('H:i:s m-d-Y').'Form Error: '.$e->getMessage()."\n", 3, __DIR__.'/../log.txt');
    header('Location: ../pages/new_post.php');
    exit();
}

$title = htmlspecialchars($_POST['title']);
$signature = htmlspecialchars($_POST['signature'] ?? 'Someone');
$postContent = htmlspecialchars($_POST['post-content']);

try {
    if (! $title) {
        throw new Exception('Post Title is missing.');
    }

    if (! $signature) {
        throw new Exception('Post Signature is missing.');
    }

    if (! $postContent) {
        throw new Exception('Post Content is missing.');
    }
} catch (Exception $e) {
    error_log(date('H:i:s m-d-Y').'Post Content Upload Error: '.$e->getMessage()."\n", 3, __DIR__.'/../log.txt');
    header('Location: ../pages/new_post.php');
    exit();
}

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
            throw new Exception('Invalid Image.');
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

        Post::addPost($title, $postContent, $signature, $fileName);
        header('Location: ../pages/index.php');
        exit();

    }
} catch (Exception $e) {
    error_log(date('H:i:s m-d-Y').'File Upload Error: '.$e->getMessage()."\n", 3, __DIR__.'/../log.txt');
    header('Location: ../pages/new_post.php');
    exit();
}

Post::addPost($title, $postContent, $signature);
header('Location: ../pages/index.php');
exit();
