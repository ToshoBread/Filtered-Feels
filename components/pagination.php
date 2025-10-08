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

<nav aria-label="Pagination">
    <ul class="pager container-fluid d-flex justify-content-center my-5">
        <a class="p-3 mx-3 text-light fw-bold" href="?page=1">First</a>

        <a class="p-3 mx-3 text-light fw-bold" href="?page=<?= prevPage($currPage)?>"><span>&laquo;</span></a>

        <p class="p-3 mx-3 text-light fw-bold"><?= $currPage?></p>

        <a class="p-3 mx-3 text-light fw-bold" href="?page=<?= nextPage($currPage, $pages)?>"><span>&raquo;</span></a>

        <a class="p-3 mx-3 text-light fw-bold" href="?page=<?= $pages?>">Last</a>
    </ul>
</nav>
<?php }?>
