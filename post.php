<?php
session_start();
$_SESSION['prev_page'] = $_SERVER['REQUEST_URI'];

require_once 'db/Post.php';
require_once 'db/User.php';
require_once 'services/util.php';
require_once 'components/navbar.php';
require_once 'components/footer.php';

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

    if (($userId !== $post['user_id'] && $userId !== 0) || ($userId === 0 && $post['user_id'] !== null)) {
        throw new Exception('User to Post mismatch');
    }
} catch (Exception $e) {
    addToErrLog('Post Display Error', $e->getMessage());
    header('Location: index.php');
    exit();
}

$headerImage = trim($post['header_image']);
$borderColor = trim($post['border_color']);
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
        <link rel="icon" type="image/x-icon" href="assets/fav_logo.svg">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="styles/base.css">
        <style>
        img:not([src=""]){aspect-ratio: 4/2; object-position: center;}
        img[src=""], img[src="#"] {display: none;}
        input[type="file"]::file-selector-button {display: none}
        </style>
    </head>
    <body>
        <?= Navbar()?>
        <input type="hidden" form="edit-post-form" name="post-id" value="<?= htmlspecialchars($postId) ?>">
        <input type="hidden" form="edit-post-form" name="user-id" value="<?= htmlspecialchars($userId) ?>">
        <input type="hidden" form="edit-post-form" id="deleted-img-flag" name="deleted-img-flag" value="0">
        <input type="hidden" form="edit-post-form" name="curr-header-img" value="<?= $headerImage ? htmlspecialchars($headerImage) : null?>">

        <div id="post-container" class="card container-lg p-0 pb-2 rounded-2 text-light"
            style="border: solid 0.15rem #<?= $borderColor ?>; background: #<?= $borderColor?>10;" >

            <div id="header-img-wrapper" class="input-group overflow-hidden w-100">
                <img
                    src="<?= $headerImage ? getImage($headerImage) : null?>"
                    class="card-img-top rounded-0 object-fit-cover"
                    id="header-img"
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


            <div class="card-body">
                <form action="../services/edit_post_validation.php" method="post" id="edit-post-form" enctype="multipart/form-data"></form>

                <?php if ((isset($_SESSION['user_id']) && $_SESSION['user_id'] === $post['user_id']) || (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin')) { ?>

                <button type="button" id="edit-post-btn" class="post-detail btn btn-outline-light border-0 float-end"><i class="bi bi-pencil-square"></i></button>

                <div class="d-flex gap-2 flex-wrap justify-content-evenly mb-2">

                    <label for="edit-header-img" class="post-input btn btn-secondary">Upload New Image</label>
                    <input type="file"
                        form="edit-post-form"
                        accept="image/*"
                        id="edit-header-img"
                        name="edit-header-img"
                        class="d-none"
                        style="cursor: pointer; user-select: none;"
                    />

                    <button form="edit-post-form" type="button" class="post-input btn btn-outline-danger px-4" data-bs-toggle="modal" data-bs-target="#confirm-delete">Delete Post</button>
                    <button form="edit-post-form" type="button" class="post-input btn btn-outline-success px-4" data-bs-toggle="modal" data-bs-target="#confirm-save">Save</button>
                    <button type="button" id="cancel-edit-btn" class="post-input btn btn-outline-danger px-4">Cancel</button>
                </div>

                <h6 class="post-input text-center text-light mt-4" style="user-select: none;">Border Color:</h6>
                <div class="post-input d-flex gap-3 flex-wrap justify-content-center mt-2 mb-4">
                    <?php
                    foreach (Colors::cases() as $color) { ?>
                    <label>
                        <input form="edit-post-form" type="radio" value="<?= colorToHex($color)?>" tabindex="-1" name="color" class="d-none"
                            <?= colorToHex($color) === $borderColor ? 'checked' : ''?>
                        />
                        <span class="color-circle rounded-circle"
                            style="background: #<?= colorToHex($color)?>;"></span>
                    </label>
                    <?php }?>
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
                    id="edit-content-area"
                    name="edit-content-area"
                    class="post-input form-control overflow-hidden"
                    placeholder="<?= $content?>"
                    aria-required="true"
                    required
                ><?= $content?></textarea>
                <?php }?>

                <p id="title" class="post-detail card-title fs-1 fw-bolder"><?= $title?></p>
                <p class="post-detail fs-5 fw-semibold">by <span id="signature"><?= $signature?></span></p>
                <p class="post-detail card-text"><?= 'Posted on: '.$createdOn?></p>
                <hr class="post-detail"/>
                <p id="content" class="post-detail card-text fs-5">
                    <?= $content?>
                </p>
            </div>
        </div>
        <!--Modals-->
        <div id="confirm-save" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to save changes?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button form="edit-post-form" type="submit" name="submit" value="save" class="btn btn-outline-success">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="confirm-delete" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this post?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button form="edit-post-form" type="submit" name="submit" value="delete" class="btn btn-danger">Delete Post</button>
                    </div>
                </div>
            </div>
        </div>

        <?= Footer()?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <script src="scripts/post.js"></script>
    </body>
</html>
