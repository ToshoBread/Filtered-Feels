<?php

require_once '../db/Post.php';
require_once '../services/helper.php';

$contentMaxLength = 200;
$contentMaxLengthWithImage = 120;

$posts = Post::selectAllPosts();

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Filtered Feels</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
            crossorigin="anonymous"
        />
    </head>
    <body class="bg-secondary-subtle" style="height: 100vh;">
        <?php require '../components/navbar.html'?>

        <div class="d-flex justify-content-center my-4">
            <a href="new_post.php" class="btn btn-primary">Voice your filtered feels</a>
        </div>

        <!--Card-->
        <!--TODO: Fix Card Wrap Layout-->
        <div
            class="container-fluid d-flex justify-content-center flex-wrap gap-5"
        >
            <?php for ($i = count($posts) - 1; $i >= 0; $i--) {
                $current = $posts[$i];
                ?>

            <div class="card shadow border-secondary" style="width: 18rem; height: 20rem;">

                <?php if ($current['header_image']) {?>

                <img
                    src="<?= getImage($current['header_image'])?>"
                    class="card-img-top"
                    style="aspect-ratio: 4/2;  object-fit: cover; object-position: center;"
                />

                <?php }?>

                <div class="card-body">
                    <h3 class="card-title"><?= $current['title']?></h3>
                    <p class="card-text">
                        <?php if (mb_strlen($current['content']) > $contentMaxLengthWithImage && $images[$i]) {
                            echo substr($current['content'], 0, $contentMaxLengthWithImage).'...';
                        } elseif (mb_strlen($current['content']) > $contentMaxLength) {
                            echo substr($current['content'], 0, $contentMaxLength).'...';
                        } else {
                            echo $current['content'];
                        }?>
                    </p>
                </div>
                <div class="text-end">
                    <div class="card-footer blockquote-footer"><?= $current['signature']?></div>
                </div>
            </div>

            <?php }?>
        </div>
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    </body>
</html>
