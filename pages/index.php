<?php
$contentMaxLength = 200;
$contentMaxLengthWithImage = 120;

$images = [
    'https://placehold.co/300x100',
    null,
];

$titles = [
    'Great Day',
    'Testing',
];

$signs = [
    'Unknown',
    'Z',
];

$content = [
    'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo esse
    sint non nisi tenetur similique laborum quo nam dignissimos
    perspiciatis.',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget egestas tortor, accumsan mollis leo. Donec quam risus, gravida et arcu ac, accumsan pharetra dui. Nam eget quam vel mi euismod placerat. Suspendisse non augue quis massa congue auctor eget quis erat. Suspendisse placerat in felis eu tristique. Quisque scelerisque.',
]
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
            <a href="new_note.php" class="btn btn-primary">Voice your filtered feels</a>
        </div>

        <!--Card-->
        <div
            class="container-fluid d-flex justify-content-center flex-wrap gap-5 my-3"
        >
            <?php for ($i = count($titles) - 1; $i >= 0; $i--) {?>

            <div class="card shadow border-secondary" style="width: 18rem; height: 20rem;">

                <?php if ($images[$i]) {?>

                <img
                    src="<?= $images[$i]?>"
                    class="card-img-top"
                    style="min-height: 30%; max-height: 30%; object-fit:cover;"
                />

                <?php }?>

                <div class="card-body">
                    <h3 class="card-title"><?= $titles[$i]?></h3>
                    <p class="card-text ">
                        <?php if (mb_strlen($content[$i]) > $contentMaxLengthWithImage && $images[$i]) {
                            echo substr($content[$i], 0, $contentMaxLengthWithImage).'...';
                        } elseif (mb_strlen($content[$i]) > $contentMaxLength) {
                            echo substr($content[$i], 0, $contentMaxLength).'...';
                        } else {
                            echo $content[$i];
                        }?>
                    </p>
                    <div class="blockquote-footer my-1" style="justify-self: end;"><?= $signs[$i]?></div>
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
