<?php
session_start();

require_once 'components/navbar.php';
require_once 'components/footer.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Filtered Feels</title>
        <link rel="icon" type="image/x-icon" href="assets/fav_logo.svg">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="styles/base.css">
    </head>
    <body>
        <?= Navbar()?>
        <div class="container my-5 text-light text-center">
            <div class="row my-5">
                    <h1 class="fw-bold">What is Filtered Feels?</h1>
                	<hr>
                    <p class="fs-3">
                        Filtered Feels is a platform where you can
                        release bottled up feelings, a space to
                        express emotions in an anonymous fashion.
                        Because some people just need to let it out
                        and filter out the real feels.
                    </p>
            </div>

            <div class="row my-5">
                    <h1 class="fw-bold">How it Started</h1>
                	<hr>
                    <p class="fs-3">
                        This project is motivated by
                        my university course, Application Development &
                        Emerging Technologies, and developed with a passion
                        for programming. Built with the Web Suite and PHP.
                    </p>
            </div>

            <div class="row my-5">
                    <h1 class="fw-bold">Contact Me</h1>
                	<hr>
                    <p class="fs-3">
                        Hi, Tosho here,<br>
                        You can reach out to me on
                        <span id="discord" class="text-decoration-underline" style="cursor: pointer;"><i class="bi bi-discord"></i>Discord</span><br>
                        and follow me on
                        <a href="https://github.com/ToshoBread" target="_blank" class="text-light"><i class="bi bi-github"></i>Github</a>
                    </p>
            </div>
        </div>

        <?= Footer()?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <script>
        const discord = document.querySelector('#discord');
        discord.onclick = () => {
            const dcUser = "tosho1821";
            navigator.clipboard.writeText(dcUser);
            alert("Copied Discord username: " + dcUser);
        };
        </script>
    </body>
</html>
