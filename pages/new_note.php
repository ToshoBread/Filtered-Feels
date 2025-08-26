<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Filtered Feels: New Note</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
            crossorigin="anonymous"
        />
        <style>
        img[src=""] {
            display: none
        }
        </style>
    </head>
    <body class="bg-secondary-subtle" style="height: 100vh">
        <?php require '../components/navbar.html'?>
        <form action="../services/new_note.php" method="post" class="container mt-5">
            <div class="mb-3 form-floating border border-secondary rounded-1">
                <input type="text" class="form-control" id="title" placeholder="" />
                <label for="title" class="form-label">Title</label>
            </div>
            <div class="mb-3 input-group-text border border-secondary">
                <label for="formFile">Header Image</label>
                <input
                    class="form-control border-secondary mx-2"
                    type="file"
                    accept="image/*"
                    id="header-img"
                />
            </div>
            <img src="" id="img-preview" class="rounded-top w-100" style="height: 20vh; object-fit: cover;" />
            <textarea
                class="form-control border border-secondary rounded-1"
                id="note-content"
                style="height: 25rem; resize: none;"
            ></textarea>
            <a href="test.php" class="btn btn-danger mt-2 px-5">Discard</a>
            <input type="submit" id="submit" class="btn btn-success mt-2 px-5 float-end" />
        </form>
        <script src="../scripts/new_note.js">
        </script>
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"
    ></script>
    </body>
</html>
