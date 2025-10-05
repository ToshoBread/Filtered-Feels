<?php
session_start();
$_SESSION['prev_page'] = $_SERVER['REQUEST_URI'];

require_once '../db/Post.php';
require_once '../services/util.php';
require_once '../components/navbar.php';
require_once '../components/card.php';

$posts = Post::selectAllPosts();

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Filtered Feels</title>
        <link rel="icon" type="image/x-icon" href="../assets/fav_logo.svg">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous"/>
        <link rel="stylesheet" href="../styles/base.css">
    </head>
    <body>
        <?= Navbar()?>

        <div class="d-flex justify-content-center my-5">
            <a href="new_post.php" id="new-post" class="btn btn-outline-light fs-4">Write New Post</a>
        </div>

        <!--TODO: Fix Card Wrap Layout-->
        <div
            class="container-fluid d-flex justify-content-center flex-wrap gap-5"
        >
            <?php for ($i = count($posts) - 1; $i >= 0; $i--) {
                $current = $posts[$i];
                (new Card(
                    $current['post_id'],
                    $current['title'],
                    $current['content'],
                    $current['signature'],
                    $current['border_color'],
                    $current['user_id'],
                    $current['header_image']
                ))->render();
            }?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <script src="../scripts/index.js"></script>
        <script src="../scripts/post.js"></script>
    </body>
</html>
