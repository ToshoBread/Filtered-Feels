<?php

function getImage(string $filename)
{
    $targetFile = '../db/uploads/'.$filename;
    try {
        if (! file_exists($targetFile)) {
            throw new Exception('Image does not exist in local system.');
        }

        return $targetFile;
    } catch (Exception $e) {
        error_log(date('H:i:s m-d-Y').'Local Error: '.$e->getMessage()."\n", 3, __DIR__.'/../log.txt');
        header('Location: ../pages/index.php');
        exit();
    }
}
