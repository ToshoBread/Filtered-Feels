<?php

session_start();

include_once '../db/Post.php';
include_once 'util.php';

$postId = htmlspecialchars($_POST['post_id']);
$userId = htmlspecialchars($_POST['user_id']);

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Incorrect Request Method');
    }

    if (isset($_POST['delete'])) {
        Post::deletePost($postId);
        header('Location: ../pages/index.php');
        exit();
    }

    if (! isset($_POST['submit'])) {
        throw new Exception('Form Submission Error');
    }
} catch (Exception $e) {
    addToErrLog('Form Error', $e->getMessage());
    header('Location: ../pages/post.php?user='.$userId.'&post='.$postId);
    exit();
}

$title = htmlspecialchars(trim($_POST['edit-title']));
$signature = htmlspecialchars(trim($_POST['edit-signature'] ?? 'Someone'));
$postContent = htmlspecialchars(trim($_POST['edit-content-area']));

try {
    if (empty($postId)) {
        throw new Exception('Post ID is missing or invalid');
    }

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
    header('Location: ../pages/post.php?user='.$userId.'&post='.$postId);
    exit();
}

try {
    if (! empty($_FILES['edit-header-img']['name'])) {
        $file = $_FILES['edit-header-img'];

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

        Post::updatePost($postId, $title, $postContent, $signature, header_image: $fileName);

        header('Location: ../pages/post.php?user='.$userId.'&post='.$postId);
        exit();

    }
} catch (Exception $e) {
    addToErrLog('File Upload Error', $e->getMessage());
    header('Location: ../pages/post.php?user='.$userId.'&post='.$postId);
    exit();
}

Post::updatePost($postId, $title, $postContent, $signature);

header('Location: ../pages/post.php?user='.$userId.'&post='.$postId);
exit();
