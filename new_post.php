<?php
session_start();
$_SESSION['prev_page'] = $_SERVER['REQUEST_URI'];

if (! empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

require_once 'components/navbar.php';
require_once 'services/util.php';
require_once 'components/footer.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Filtered Feels: New Post</title>
        <link rel="icon" type="image/x-icon" href="assets/fav_logo.svg">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="styles/base.css">
    </head>
    <body>
        <?= Navbar()?>
        <form action="services/new_post_validation.php"
            method="post" enctype="multipart/form-data"
            id="new-post-form"
            class="container-md mt-5 rounded-2 p-4">
            <div class="form-floating my-3">
                <input
                    type="text"
                    minlength="3"
                    maxlength="50"
                    class="form-control border fs-5"
                    id="title"
                    name="title"
                    placeholder=""
                    aria-required="true"
                    aria-label="Input Title"
                    required
                />
                <label for="title">Title</label>
            </div>
            <div class="form-floating my-3">
                <input
                    type="text"
                    maxlength="30"
                    class="form-control border fs-5"
                    id="signature"
                    name="signature"
                    placeholder="Someone"
                    value=<?= $username ?? 'Someone'?>
                    aria-required="false"
                    aria-label="Input Signature"
                />
                <label for="signature">Signature</label>
            </div>
            <div class="d-flex gap-3 flex-wrap justify-content-center mb-3">
                <?php
                foreach (Colors::cases() as $color) { ?>
                <label>
                    <input type="radio" value="<?= colorToHex($color)?>" tabindex="-1" name="color" class="d-none"
                        <?= colorToHex($color) === 'FFFFFF' ? 'checked' : ''?>
                    />
                    <span class="color-circle rounded-circle"
                        style="background: #<?= colorToHex($color)?>;"></span>
                </label>
                <?php }?>
            </div>
            <label class="btn border mb-3 col col-4 offset-4" 
                for="input-header-img">Upload Header Image</label>
            <input
                type="file"
                accept="image/*"
                id="input-header-img"
                name="header-img"
                class="d-none"
                aria-label="Input Header Image"
            />
            <div class="input-group overflow-hidden w-100">
                <img
                    src=""
                    id="img-preview"
                    class="w-100 h-100 object-fit-cover border-top"
                    style="aspect-ratio: 4/2; object-position: center;"
                    aria-label="Image Preview"
                />
                <div class="card-img-overlay m-2">
                    <button
                        type="button"
                        id="remove-img-btn"
                        class="btn btn-outline-danger float-end"
                        aria-label="Close Image Preview"
                    ><i class="bi bi-x-lg fs-6"></i></button>
                </div>
            </div>
            <textarea
                placeholder="Write here..."
                minlength="3"
                id="post-content"
                name="post-content"
                class="border rounded-1 mb-3 w-100 p-2"
                style="min-height: 25rem; resize: none; field-sizing: content;"
                aria-required="true"
                required
            ></textarea>
            <input type="submit" value="Post" id="submit-btn" name="submit" class="btn btn-outline-success px-5 fs-5 col col-12" aria-label="Submit" />
        </form>
        <?= Footer()?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <script src="scripts/new_post.js"></script>
    </body>
</html>
