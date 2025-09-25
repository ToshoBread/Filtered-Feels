<?php

session_start();

include_once '../db/User.php';
include_once 'helper.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Incorrect Request Method');
    }

    if (! isset($_POST['login-submit'])) {
        throw new Exception('Form Submission Error');
    }
} catch (Exception $e) {
    addToErrLog('Form Error', $e->getMessage());
    header('Location: ../pages/account.php');
    exit();
}

$username = htmlspecialchars(trim($_POST['login-username']));
$password = htmlspecialchars(trim($_POST['login-password']));

try {
    if (empty($username)) {
        throw new Exception('Username is missing.');
    }

    if (empty($password)) {
        throw new Exception('Password is missing.');
    }

} catch (Exception $e) {
    addToErrLog('Empty Field Error', $e->getMessage());
    header('Location: ../pages/account.php');
    exit();
}

$user = User::getUser($username);

try {
    if (empty($user)) {
        throw new Exception('User not found');
    }

    if (! password_verify($password, $user['hashed_password'])) {
        throw new Exception('Incorrect Password');
    }

} catch (Exception $e) {
    addToErrLog('User Verification Error', $e->getMessage());
    header('Location: ../pages/account.php');
    exit();
}

$_SESSION['username'] = $username;
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['role'] = $user['role'];
$_SESSION['created_on'] = $user['created_on'];
header('Location: ../pages/index.php');
exit();
