<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/layout.php';

$pageTitle = $params['post']->getTitle();

?>

<section class="section">

    <article>

        <header>
            <h1><?= $params['post']->getTitle() ?></h1>
            <time class="date"><?= date('F j, Y, g:i A', strtotime($params['post']->getCreatedAt())) ?></time>
        </header>

        <?php
        $imageDir = ROOT_DIRECTORY . '/public/upload/post/';
        $imagePath = $imageDir . $params['post']->getImage();
        if ($imagePath !== $imageDir && file_exists($imagePath)) {
        ?>
            <img src="<?= HTTP_HOST . '/upload/post/' . $params['post']->getImage() ?>" alt="<?= $params['post']->getTitle() ?>" class="post-image lightbox-item">
            <div class="lightbox">
                <div class="lightbox-close">
                    &times;
                </div>
                <img src="<?= HTTP_HOST . '/upload/post/' . $params['post']->getImage() ?>" alt="" class="lightbox-image">
            </div>
        <?php
        }
        ?>

        <p><?= $params['post']->getContent() ?></p>

    </article>

</section>