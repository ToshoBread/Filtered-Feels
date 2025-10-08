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

<nav aria-label="Top Pagination">
    <ul class="pagination justify-content-center gap-5 flex-wrap my-5">
        <li class="page-item"><a href="?page=1">First Page</a></li>

        <li class="page-item"><a href="?page=<?= prevPage($currPage)?>">
            <span>&laquo;</span></a></li>

        <li class="page-item"><p class="text-light"><?= $currPage?></p></li>

        <li class="page-item"><a href="?page=<?= nextPage($currPage, $pages)?>"> 
            <span>&raquo;</span></a></li>

        <li class="page-item"><a href="?page=<?= $pages?>"  >Last Page</a></li>
    </ul>
</nav>
<?php }?>
