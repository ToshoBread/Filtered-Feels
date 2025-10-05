<?php
require_once '../components/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Filtered Feels</title>
        <link rel="icon" type="image/x-icon" href="../assets/fav_logo.svg">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous"/>
        <link rel="stylesheet" href="../styles/base.css">
    </head>
    <body>
        <?= Navbar()?>
        <div class="container my-5 text-light text-center">
            <div class="row my-5">
                <div class="col-md-6">
                    <h1 class="fw-bold">What is Filtered Feels?</h1>
                </div>
                <div class="col-md-6">
                    <p class="fs-3">
                        Filtered Feels is a platform where you can
                        release bottled up feelings, a space to
                        express emotions in an anonymous fashion.
                        Because some people just need to let it out
                        and filter out the real feels.
                    </p>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-md-6">
                    <h1 class="fw-bold">How it Started</h1>
                </div>
                <div class="col-md-6">
                    <p class="fs-3">
                        This project is motivated by
                        my university course, Application Development &
                        Emerging Technologies, and developed with a passion
                        for programming. Built with the Web Suite and PHP.
                    </p>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-md-6">
                    <h1 class="fw-bold">Contact Me</h1>
                </div>
                <div class="col-md-6">
                    <p class="fs-3">
                        You can reach out to me on
                        <span id="discord" class="text-decoration-underline" style="cursor: pointer;">Discord</span><br>
                        and follow me on
                        <a href="https://github.com/ToshoBread" class="text-light">Github</a>
                    </p>
                </div>
            </div>
        </div>

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
