<?php

class Card
{
    private $contentMaxLength = 320;

    private $contentMaxLenWithImg = 120;

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
            />

            <?php }?>

            <div class="card-body">
                <h3 class="card-title"><?= $this->title?></h3>
                <p class="card-text">
                    <?php
                    if ($this->headerImage && mb_strlen($this->content) > $this->contentMaxLenWithImg) {
                        echo substr($this->content, 0, $this->contentMaxLenWithImg).'...';
                    } elseif (mb_strlen($this->content) > $this->contentMaxLength) {
                        echo substr($this->content, 0, $this->contentMaxLength).'...';
                    } else {
                        echo $this->content;
                    }
        ?>
                </p>
            </div>
            <div class="card-footer blockquote-footer text-end"><?= $this->signature?></div>
        </div>
        <?php
    }
}
