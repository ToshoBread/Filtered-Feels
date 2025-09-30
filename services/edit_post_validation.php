<?php

session_start();

include_once '../db/Post.php';
include_once 'util.php';

$postId = htmlspecialchars($_POST['post-id']);
$userId = htmlspecialchars($_POST['user-id']);

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Incorrect Request Method');
    }

    if (isset($_POST['delete'])) {
        Post::deletePost($postId);
        if (! empty($_SESSION['prev_page'])) {
            $uri = $_SESSION['prev_page'];
            header('Location: '.$_SESSION['prev_page']);
            exit();
        }
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
$currHeaderImg = htmlspecialchars($_POST['curr-header-img']);
$deletedImgFlag = (bool) htmlspecialchars($_POST['deleted-img-flag']);

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

    if (! isset($deletedImgFlag)) {
        throw new Exception('Header image observer is missing');
    }
} catch (Exception $e) {
    addToErrLog('Post Content Upload Error', $e->getMessage());
    header('Location: ../pages/post.php?user='.$userId.'&post='.$postId);
    exit();
}

try {
    $uploadDest = '../db/uploads/';
    if (! empty($_FILES['edit-header-img']['name'])) {
        $file = $_FILES['edit-header-img'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('File error '.$file['error']);
        }

        if (! is_dir($uploadDest) && ! mkdir($uploadDest, 0755, true) && ! is_dir($uploadDest)) {
            throw new Exception('Failed to create directory');
        }

        $fileName = isValidImage($file);

        if (! move_uploaded_file($file['tmp_name'], $uploadDest.$fileName)) {
            throw new Exception('Failed to upload Image.');
        }

        Post::updatePost($postId, $title, $postContent, $signature, header_image: $fileName);

        if ($currHeaderImg) {
            file_exists($uploadDest.$currHeaderImg) && unlink($uploadDest.$currHeaderImg);
        }

        header('Location: ../pages/post.php?user='.$userId.'&post='.$postId);
        exit();
    }

    if ($deletedImgFlag) {
        Post::updatePost($postId, $title, $postContent, $signature);
        file_exists($uploadDest.$currHeaderImg) && unlink($uploadDest.$currHeaderImg);
    }

    header('Location: ../pages/post.php?user='.$userId.'&post='.$postId);
    exit();
} catch (Exception $e) {
    addToErrLog('Image handling Error', $e->getMessage());
    header('Location: ../pages/post.php?user='.$userId.'&post='.$postId);
    exit();
}

Post::updatePost($postId, $title, $postContent, $signature, $currHeaderImg);

header('Location: ../pages/post.php?user='.$userId.'&post='.$postId);
exit();
