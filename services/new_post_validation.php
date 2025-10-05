<?php

session_start();

include_once '../db/Post.php';
include_once 'util.php';

$title = '';
$signature = '';
$postContent = '';
$fileName = '';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Incorrect Request Method');
    }

    if (! isset($_POST['submit'])) {
        throw new Exception('Form Submission Error');
    }
} catch (Exception $e) {
    addToErrLog('Form Error', $e->getMessage());
    header('Location: ../pages/new_post.php');
    exit();
}

$title = htmlspecialchars(trim($_POST['title']));
$signature = htmlspecialchars(trim($_POST['signature'] ?? 'Someone'));
$postContent = htmlspecialchars(trim($_POST['post-content']));
$color = htmlspecialchars(trim($_POST['color'] ?? 'FFFFFF'));

try {
    if (empty($title)) {
        throw new Exception('Post Title is missing.');
    }

    if (empty($signature)) {
        throw new Exception('Post Signature is missing.');
    }

    if (empty($postContent)) {
        throw new Exception('Post Content is missing.');
    }
} catch (Exception $e) {
    addToErrLog('Post Content Upload Error', $e->getMessage());
    header('Location: ../pages/new_post.php');
    exit();
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
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

        $fileName = isValidImage($file);

        if (! move_uploaded_file($file['tmp_name'], $uploadDest.$fileName)) {
            throw new Exception('Failed to upload Image.');
        }
        if (isset($userId)) {
            Post::addPost(
                title: $title,
                content: $postContent,
                signature: $signature,
                border_color: $color,
                user_id: $userId,
                header_image: $fileName,
            );
        } else {
            Post::addPost(
                title: $title,
                content: $postContent,
                signature: $signature,
                border_color: $color,
                header_image: $fileName,
            );
        }

        header('Location: ../pages/index.php');
        exit();

    }
} catch (Exception $e) {
    addToErrLog('File Upload Error', $e->getMessage());
    header('Location: ../pages/new_post.php');
    exit();
}

if (isset($userId)) {
    Post::addPost(
        title: $title,
        content: $postContent,
        signature: $signature,
        border_color: $color,
        user_id: $userId,
    );
} else {
    Post::addPost(
        title: $title,
        content: $postContent,
        signature: $signature,
        border_color: $color,
    );
}

header('Location: ../pages/index.php');
exit();
