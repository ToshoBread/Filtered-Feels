<?php

class Card
{
    private int $postId;

    private ?int $userId;

    private string $title;

    private string $content;

    private string $signature;

    private string $color;

    private ?string $headerImage;

    public function __construct(int $postId, string $title, string $content, ?string $signature = 'Someone', ?string $color = 'FFFFFF', ?int $userId = 0, ?string $headerImage = null)
    {
        $this->postId = $postId;
        $this->title = $title;
        $this->content = $content;
        $this->signature = $signature;
        $this->color = $color;
        $this->userId = $userId;
        $this->headerImage = $headerImage;
    }

    public function render()
    {
        ?>
        <div class="post card text-light shadow"
            style=" border: solid 0.15rem #<?= $this->color ?>;
            background: #<?= $this->color ?>10;"
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
