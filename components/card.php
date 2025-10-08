<?php

class Card
{
    private int $postId;

    private ?int $userId;

    private string $title;

    private string $content;

    private string $signature;

    private string $borderColor;

    private ?string $headerImage;

    public function __construct(int $postId, string $title, string $content, ?string $signature = 'Someone', ?string $borderColor = 'FFFFFF', ?int $userId = 0, ?string $headerImage = null)
    {
        $this->postId = $postId;
        $this->title = $title;
        $this->content = $content;
        $this->signature = $signature;
        $this->borderColor = $borderColor;
        $this->userId = $userId;
        $this->headerImage = $headerImage;
    }

    public function render()
    {
        ?>
        <div class="post card text-light shadow"
            style="border: solid 0.15rem #<?= $this->borderColor ?>;"
            data-post-id="<?= $this->postId ?>"
            data-user-id="<?= $this->userId ?? 0 ?>">

            <?php if ($this->headerImage) {?>

            <img
                src="<?= getImage($this->headerImage)?>"
                class="card-img-top"
                style="aspect-ratio: 4/2;  object-fit: cover; object-position: center;"
                loading="lazy"
            />

            <?php }?>

            <div class="card-body" style="overflow-y: hidden; margin-bottom: 1rem !important;">
                <h3 class="card-title fw-bold"><?= $this->title?></h3>
                <p class="card-text"><?= $this->content; ?></p>
            </div>
            <div class="card-footer blockquote-footer text-end"><?= $this->signature?></div>
        </div>
        <?php
    }
}
