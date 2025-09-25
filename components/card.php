<?php

class Card
{
    private $contentMaxLength = 315;

    private $contentMaxLenWithImg = 120;

    private int $postId;

    private string $title;

    private string $content;

    private string $signature;

    private ?string $headerImage;

    public function __construct(int $postId, string $title, string $content, string $signature, ?string $headerImage = null)
    {
        $this->postId = $postId;
        $this->title = $title;
        $this->content = $content;
        $this->signature = $signature;
        $this->headerImage = $headerImage;
    }

    public function getId()
    {
        return $this->postId;
    }

    public function render()
    {?>
        <div class="card shadow border-secondary" style="width: 18rem; height: 24rem;">

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
