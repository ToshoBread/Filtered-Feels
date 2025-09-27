<?php
session_start();

require_once '../db/Post.php';
require_once '../db/User.php';
require_once '../services/util.php';
require_once '../components/navbar.php';

$postId = (int) $_GET['post'];
$userId = (int) $_GET['user'];

$post = Post::selectPostByPostId($postId);
$user = User::selectUserById($userId);

try {
    if (empty($postId)) {
        throw new Exception('Post ID is missing');
    }

    if (empty($post)) {
        throw new Exception('Post does not exist');
    }

    if ($userId != 0 && empty($user)) {
        throw new Exception('User does not exist');
    }

    if ($userId !== 0 && $userId !== $post['user_id']) {
        throw new Exception('User to Post mismatch');
    }
} catch (Exception $e) {
    addToErrLog('Post Display Error', $e->getMessage());
    header('Location: ../pages/index.php');
    exit();
}

$headerImage = trim($post['header_image']);
$title = trim($post['title']);
$signature = trim($post['signature']);
$content = trim($post['content']);
$createdOn = strtok($post['created_on'], ' ');

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Filtered Feels: <?= $post['title']?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <style>
        img[src=""] {display: none}
        input[type="file"]::file-selector-button {display: none}
        </style>
    </head>
    <body class="bg-secondary-subtle" style="min-height: 100vh;">
        <?= Navbar()?>
        <div class="card container p-0 pb-2 shadow border-secondary rounded-0 rounded-bottom" >

            <?php if ($headerImage) {?>
            <div id="header-img-wrapper" class="input-group overflow-hidden w-100">
                <img src="<?= getImage($headerImage)?>"
                    id="header-img"
                    class="card-img-top rounded-0 object-fit-cover"
                    style="aspect-ratio: 4/2; object-position: center;"
                />
                <div class="post-input card-img-overlay m-2">
                    <button
                        type="button"
                        id="remove-img-btn"
                        class="btn btn-outline-danger float-end"
                        aria-label="Close Image Preview"
                    ><i class="bi bi-x-lg fs-6"></i></button>
                </div>
            </div>
            <?php }?>


            <div class="card-body">
                <form action="" method="post" id="edit-post-form" enctype="multipart/form-data"></form>

                <?php if ($_SESSION['user_id'] === $post['user_id'] || $_SESSION['role'] === 'Admin') { ?>

                <button type="button" id="edit-post-btn" class="post-detail btn btn-outline-secondary border-0 float-end"><i class="bi bi-pencil-square"></i></button>

                <div class="d-flex gap-2 flex-wrap-reverse justify-content-center mb-2">

                    <div id="change-img-btn" class="post-input">
                        <label for="edit-header-img" class="btn btn-secondary">Upload New Image</label>
                        <input type="file"
                            accept="image/*"
                            id="edit-header-img"
                            class="d-none"
                            style="cursor: pointer; user-select: none;"
                        />
                        <span id='display-new-image'></span>
                    </div>

                    <button form='edit-post-form' type="submit" id="save-edit-btn" class="post-input btn btn-primary px-4">Save</button>
                    <button type="button" id="cancel-edit-btn" class="post-input btn btn-danger px-4">Cancel</button>
                </div>

                <input
                    form="edit-post-form"
                    type="text" 
                    id="edit-title"
                    name="edit-title"
                    placeholder="<?= $title?>"
                    value="<?= $title?>"
                    minlength="3"
                    maxlength="50"
                    class="post-input form-control fw-bolder fs-1 mb-3"
                    aria-required="true"
                    required
                />

                <div class="post-input">
                    <label for="edit-signature" class="form-label fw-semibold fs-5">by</label>
                    <input 
                        form="edit-post-form"
                        type="text"
                        id="edit-signature"
                        name="edit-signature"
                        placeholder="<?= $signature?>"
                        value="<?= $signature?>"
                        class="form-control fw-semibold fs-5"
                        aria-required="true"
                        required
                    />
                </div>
                <p class="post-input card-text text-secondary"><?= 'Posted on: '.$createdOn?></p>
                <hr class="post-input"/>
                <textarea
                    form="edit-post-form"
                    type="text"
                    id="edit-content-area"
                    name="edit-content-area"
                    rows="1"
                    class="post-input form-control overflow-hidden"
                    style="resize: none;"
                    aria-required="true"
                    required
                ><?= $content?>
                </textarea>
                <?php }?>

                <p id="title" class="post-detail card-title fs-1 fw-bolder"><?= $title?></p>
                <p class="post-detail fs-5 fw-semibold">by <span id="signature"><?= $signature?></span></p>
                <p class="post-detail card-text text-secondary"><?= 'Posted on: '.$createdOn?></p>
                <hr class="post-detail"/>
                <p id="content" class="post-detail card-text fs-5">
                    <?= $content?>
                </p>
            </div>
        </div>
        <!--Modals-->
        <div class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <script src="../scripts/post.js"></script>
    </body>
</html>
