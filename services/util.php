<?php

function addToErrLog(string $headerMessage, string $errMessage)
{
    $dateTime = new DateTime('now', new DateTimeZone('Asia/Manila'));

    error_log("[{$dateTime->format('H:i:s m-d-Y')}] {$headerMessage}: {$errMessage}\n", 3, __DIR__.'/../log.txt');
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

function isValidImage($file)
{
    $sanitizedName = preg_replace('/[^a-zA-Z0-9._-]/', '', basename($file['name']));
    $fileName = uniqid().'-'.$sanitizedName;
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

    $validFormats = ['jpg', 'jpeg', 'png'];
    if (! in_array($fileExt, $validFormats)) {
        throw new Exception('Invalid File Format: '.$fileExt);
    }

    return $fileName;
}
