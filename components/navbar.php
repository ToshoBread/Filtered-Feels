<nav class="navbar navbar-expand-md navbar-dark text-bg-dark sticky-top">
    <div class="container-fluid">
        <img src="https://placehold.co/50" class="navbar-brand" />
        <button
            class="navbar-toggler"
            data-bs-toggle="offcanvas"
            data-bs-target="#nav"
            aria-controls="nav"
            aria-label="Expand Off Canvas Navigation"
            aria-expanded="false"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end text-bg-dark" id="nav">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Filtered Feels</h5>
                <button
                    class="btn-close btn-close-white"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close Nav"
                ></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="new_post.php" class="nav-link">Write New Post</a>
                    </li>
                </ul>
                <hr />
                <ul class="navbar-nav ms-auto gap-3">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">About</a>
                    </li>
                    <?php
                    if (isset($_SESSION['user_id'])) {?>

                    <li class="nav-item">
                        <a href="profile.php" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form action="index.php" method="post">
                            <input type="submit" value="Logout" name="logout" class="nav-link"/>
                        </form>
                    </li>
                    <?php } else {?>

                    <li class="nav-item">
                        <a href="account.php" class="nav-link">Login</a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</nav>
<script src="../scripts/navbar.js"></script>
<?php if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ../pages/index.php');
    exit();
} ?>

