<?php
session_start();
$_SESSION['prev_page'] = $_SERVER['REQUEST_URI'];

if (empty($_SESSION['user_id']) || empty($_SESSION['username'])) {
    header('Location: account.php');
}

require_once '../db/Post.php';
require_once '../services/util.php';
require_once '../components/navbar.php';
require_once '../components/card.php';

$posts = Post::selectPostByUserId($_SESSION['user_id']);
$username = $_SESSION['username'];
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Filtered Feels: Profile</title>
        <link rel="icon" type="image/x-icon" href="../assets/fav_logo.svg">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous"/>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        />
        <link rel="stylesheet" href="../styles/base.css">
    </head>
    <body>
        <?= Navbar()?>
        <div class="container-fluid p-4 mb-4 rounded-bottom shadow text-light">
            <h4 class="text-center"><?= $username.(substr($username, -1) === 's' ? "'" : "'s") ?> Profile</h4>
            <hr />
            <div class="d-flex justify-content-evenly">
                <h5>Posts: <?= count($posts); ?></h5>
                <h5>Date Joined: <?= strtok($_SESSION['created_on'], ' ')?></h5>
            </div>
        </div>
        <div
            class="container-fluid d-flex justify-content-center flex-wrap gap-5"
        >
            <?php if (! empty($posts)) {
                for ($i = count($posts) - 1; $i >= 0; $i--) {
                    $current = $posts[$i];
                    (new Card(
                        $current['post_id'],
                        $current['title'],
                        $current['content'],
                        $current['signature'],
                        $current['user_id'],
                        $current['header_image']
                    ))->render();
                }
            }?>
        </div>

        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
        <script src="../scripts/post.js"></script>
    </body>
</html>
