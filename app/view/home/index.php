<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/layout.php';

$pageTitle = 'Home';

?>

<header class="home-header">
    <h1>PHP Blog</h1>
    <p>Blog written in vanilla PHP and object-oriented programming</p>
</header>

<section class="section">
    <h2>Most recent posts</h2>
    <br>
    <div class="col-3">
        <?php foreach ($params['latestPosts'] as $post) : ?>
            <div>
                <h3><?= $post->getTitle() ?></h3>
                <time class="date"><?= date('F j, Y, g:i A', strtotime($post->getCreatedAt())) ?></time>
                <?php
                if ($post->getImageThumb() !== '') {
                    $imagePath = ROOT_DIRECTORY . '/public/upload/post/' . $post->getImageThumb();
                    if (file_exists($imagePath)) {
                ?>
                        <img src="<?= HTTP_HOST . '/upload/post/' . $post->getImageThumb() ?>" alt="<?= $post->getTitle() ?>" class="thumbnail">
                <?php
                    }
                }
                ?>
                <p><?= $post->getShortContent() ?></p>
                <br>
                <a href="./post/<?= $post->getSlug() . '-' . $post->getId() ?>" class="btn">Read</a>
            </div>
        <?php endforeach; ?>
    </div>
    <br>
    <a href="<?= HTTP_HOST ?>/blog">View all</a>
</section>