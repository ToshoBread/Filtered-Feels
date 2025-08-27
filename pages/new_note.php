<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Filtered Feels: New Note</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <style>
        img[src=""] {display: none}
        input[type="file"]::file-selector-button {display: none}
        label {cursor: pointer; user-select: none;}
        </style>
    </head>
    <body class="bg-secondary-subtle" style="min-height: 100vh;">
        <?php require '../components/navbar.html'?>
        <form action="../services/new_note.php" method="post" class="container mt-5">
            <div class="mb-3 input-group-text border border-secondary rounded-1">
                <label for="title">Title</label>
                <input
                    type="text"
                    minlength="3"
                    maxlength="5"
                    class="form-control mx-3 border border-secondary px-1"
                    id="title"
                    aria-required="true"
                    aria-label="Input Title"
                    required
                />
                <label for="signature">Signature</label>
                <input
                    type="text"
                    maxlength="30"
                    class="form-control mx-3 border border-secondary px-1"
                    id="signature"
                    placeholder="Someone"
                    value="Someone"
                    aria-required="false"
                    aria-label="Input Signature"
                />
            </div>
            <div class="mb-3 input-group-text border border-secondary">
                <label for="input-header-img">Header Image</label>
                <input
                    class="form-control border-secondary mx-2"
                    type="file"
                    accept="image/*"
                    id="input-header-img"
                    aria-label="Input Header Image"
                />
            </div>
            <div class="input-group overflow-hidden w-100">
                <img
                    src=""
                    id="img-preview"
                    class="w-100 h-100"
                    style="aspect-ratio: 4/1; object-fit: cover; object-position: center;"
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
                id="note-content"
                class="form-control border border-secondary rounded-1"
                style="height: 25rem; resize: none;"
                aria-required="true"
                required
            ></textarea>
            <input type="reset" value="Reset" id="discard-btn" class="btn btn-danger mt-2 px-5" aria-label="Reset">
            <input type="submit" value="Post" id="submit-btn" class="btn btn-success mt-2 px-5 float-end" aria-label="Submit" />
        </form>
        <script src="../scripts/new_note.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    </body>
</html>
