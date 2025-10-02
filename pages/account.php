<?php
session_start();

require_once '../components/navbar.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Filtered Feels: User Account</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="../styles/base.css">
    </head>
    <body class="bg-secondary-subtle" style="height: 100vh">
        <?= Navbar()?>
        <div
            class="container-fluid row align-items-center justify-content-center h-75"
        >
            <form
                action="../services/account_validation.php"
                method="post"
                enctype="application/x-www-form-urlencoded"
                id="login-form"
                class="col col-auto p-4 border border-secondary rounded-1 shadow"
            >
                <div class="form-floating my-3">
                    <input
                        type="text"
                        minlength="8"
                        maxlength="30"
                        class="form-control border border-secondary"
                        name="login-username"
                        placeholder=""
                        aria-required="true"
                        aria-label="Input Username"
                        required
                    />
                    <label for="username">Username</label>
                </div>
                <div class="form-floating my-3">
                    <input
                        type="password"
                        minlength="8"
                        maxlength="255"
                        class="form-control border border-secondary"
                        name="login-password"
                        placeholder=""
                        aria-required="true"
                        aria-label="Input Password"
                        required
                    />
                    <label for="password">Password</label>
                </div>
                <input
                    type="submit"
                    value="Login"
                    name="login-submit"
                    class="btn btn-outline-success my-3 col col-12"
                    aria-label="Submit"
                />
                <button type="button" id="swap-to-reg" class="btn btn-outline-secondary col col-12">
                    No Account? Register Here
                </button>
            </form>

            <!--Registration Form-->
            <form
                action="../services/account_registration.php"
                method="post"
                enctype="application/x-www-form-urlencoded"
                id="register-form"
                class="col col-auto p-4 border border-secondary rounded-1 d-none shadow"
            >
                <div class="form-floating my-3">
                    <input
                        type="text"
                        minlength="8"
                        maxlength="30"
                        class="form-control border border-secondary"
                        name="reg-username"
                        placeholder=""
                        aria-required="true"
                        aria-label="Input Username"
                        required
                    />
                    <label for="username">Username</label>
                </div>
                <div class="form-floating my-3">
                    <input
                        type="password"
                        minlength="8"
                        maxlength="255"
                        class="form-control border border-secondary"
                        name="reg-password"
                        placeholder=""
                        aria-required="true"
                        aria-label="Input Password"
                        required
                    />
                    <label for="password">Password</label>
                </div>
                <div class="form-floating my-3">
                    <input
                        type="password"
                        maxlength="30"
                        class="form-control border border-secondary"
                        name="confirm-pass"
                        placeholder=""
                        aria-required="true"
                        aria-label="Confirm Password"
                        required
                    />
                    <label for="confirmPass">Confirm Password</label>
                </div>
                <input
                    type="submit"
                    value="Register"
                    name="reg-submit"
                    class="btn btn-outline-primary my-3 col col-12"
                    aria-label="Submit"
                />
                <button type="button" id="swap-to-login" class="btn btn-outline-secondary col col-12">
                    Have an account? Login here
                </button>
            </form>
        </div>
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
        <script src="../scripts/account.js"></script>
    </body>
</html>
