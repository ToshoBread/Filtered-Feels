<?php

include_once '../db/User.php';
include_once 'helper.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Incorrect Request Method');
    }

    if (! isset($_POST['reg-submit'])) {
        throw new Exception('Form Submission Error');
    }
} catch (Exception $e) {
    addToErrLog('Form Error', $e->getMessage());
    header('Location: ../pages/account.php');
    exit();
}

$username = htmlspecialchars($_POST['reg-username']);
$password = htmlspecialchars($_POST['reg-password']);
$confirmPass = htmlspecialchars($_POST['confirm-pass']);

try {
    if (empty($username)) {
        throw new Exception('Username is missing.');
    }

    if (empty($password)) {
        throw new Exception('Password is missing.');
    }

    if (empty($confirmPass)) {
        throw new Exception('Confirm Password is missing.');
    }
} catch (Exception $e) {
    addToErrLog('Empty Field Error', $e->getMessage());
    header('Location: ../pages/account.php');
    exit();
}

try {
    if ($password !== $confirmPass) {
        throw new Exception("Passwords Don't Match");
    }

    if (mb_strlen($password) < 8) {
        throw new Exception('Password too short');
    }
} catch (Exception $e) {
    addToErrLog('Password Error', $e->getMessage());
    header('Location: ../pages/account.php');
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
User::addUser($username, $hashedPassword);
header('Location: ../pages/account.php');
exit();
