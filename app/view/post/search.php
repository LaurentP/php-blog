<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/layout.php';

$pageTitle = 'Blog';

?>

<h1>Blog</h1>

<h2>Search results : <?= $params['count'] ?> found</h2>

<div class="col-3">
    <?php foreach ($params['postList'] as $post) : ?>
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

<nav class="pagination">
    <ul>
        <?php
        if ($params['currentPage'] > 1) {
        ?>
            <li><a href="<?= HTTP_HOST ?>/blog/search?q=<?= $params['query'] ?>&p=<?= $params['currentPage'] - 1 ?>">&laquo; Prev</a></li>
            <?php
        }

        for ($i = 1; $i <= $params['requiredPages']; $i++) {

            if ($params['currentPage'] === $i) {
            ?>
                <li><a href="<?= HTTP_HOST ?>/blog/search?q=<?= $params['query'] ?>&p=<?= $i ?>" class="pagination-active"><?= $i ?></a></li>
            <?php
            } else {
            ?>
                <li><a href="<?= HTTP_HOST ?>/blog/search?q=<?= $params['query'] ?>&p=<?= $i ?>"><?= $i ?></a></li>
            <?php
            }
        }

        if ($params['currentPage'] < $params['requiredPages']) {
            ?>
            <li><a href="<?= HTTP_HOST ?>/blog/search?q=<?= $params['query'] ?>&p=<?= $params['currentPage'] + 1 ?>">Next &raquo;</a></li>
        <?php
        }
        ?>
    </ul>
</nav>