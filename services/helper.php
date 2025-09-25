<?php

function addToErrLog(string $headerMessage, string $errMessage)
{
    $dateTime = new DateTime('now', new DateTimeZone('Asia/Manila'));
    error_log("[{$dateTime->format('H:i:s m-d-Y')}] {$headerMessage}: {$errMessage}\n",
        3, __DIR__.'/../log.txt');
}

function getImage(string $filename)
{
    $targetFile = '../db/uploads/'.$filename;
    try {
        if (! file_exists($targetFile)) {
            throw new Exception('Image does not exist in local system.');
        }

        return $targetFile;
    } catch (Exception $e) {
        addToErrLog('Local Error', $e->getMessage());
        header('Location: ../pages/index.php');
        exit();
    }
}
