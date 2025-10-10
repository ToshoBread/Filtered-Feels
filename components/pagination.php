<?php
function prevPage(int $currPage)
{
    $currPage--;

    return $currPage <= 1 ? 1 : $currPage;
}

function nextPage(int $currPage, int $pages)
{
    $currPage++;

    return $currPage >= $pages ? $pages : $currPage;
}

function Pagination(int $currPage, int $pages)
{?>

    <?php if ($pages > 1) {?>
        <nav aria-label="Pagination">
            <ul class="pager container-fluid d-flex justify-content-center my-5 fs-5">
                <?php if ($currPage > 2) { ?>
                <a class="p-3 text-light fw-bold" href="?page=1">1</a>
                <?php } ?>

                <?php if ($currPage > 1) {?>
                <a class="p-3 text-light fw-bold" href="?page=<?= prevPage($currPage)?>"><i class="bi bi-caret-left-fill"></i></a>
                <a href="?page=<?= prevPage($currPage) ?>" class="p-3 text-light fw-bold"><?= $currPage - 1?></a>
                <?php } ?>

                <p class="p-3 text-light fw-bold"><?= $currPage?></p>

                <?php if ($currPage < $pages) {?>
                <a href="?page=<?= nextPage($currPage, $pages) ?>" class="p-3 text-light fw-bold"><?= $currPage + 1?></a>
                <a class="p-3 text-light fw-bold" href="?page=<?= nextPage($currPage, $pages)?>"><i class="bi bi-caret-right-fill"></i></a>
                <?php } ?>

                <?php if ($currPage < $pages - 1) { ?>
                <a class="p-3 text-light fw-bold" href="?page=<?= $pages?>"><?= $pages?></a>
                <?php } ?>

            </ul>
        </nav>
        <?php }
    }
?>
