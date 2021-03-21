<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/layout.php';

$pageTitle = 'Blog';

?>

<h1>Blog</h1>

<h2>Search results : <?= $params['count'] ?> found</h2>

<?php foreach ($params['postList'] as $post) : ?>
    <div>
        <h3><?= $post->getTitle() ?></h3>
        <time><?= date('F j, Y, g:i A', strtotime($post->getCreatedAt())) ?></time>
        <?php
        if ($post->getThumbnailImage() !== '') {
            $imagePath = ROOT_DIRECTORY . '/public/upload/post/' . $post->getThumbnailImage();
            if (file_exists($imagePath)) {
        ?>
                <div>
                    <img src="<?= HTTP_HOST . '/upload/post/' . $post->getThumbnailImage() ?>" alt="<?= $post->getTitle() ?>">
                </div>
        <?php
            }
        }
        ?>
        <p><?= $post->getShortContent() ?></p>
        <a href="<?= HTTP_HOST ?>/post/<?= $post->getSlug() . '-' . $post->getId() ?>">Read</a>
    </div>
<?php endforeach; ?>

<div class="pagination">
    <?php
    if ($params['currentPage'] > 1) {
    ?>
        <a href="<?= HTTP_HOST ?>/blog/search?q=<?= $params['query'] ?>&p=<?= $params['currentPage'] - 1 ?>">Prev</a>
    <?php
    }
    for ($i = 1; $i <= $params['requiredPages']; $i++) {
    ?>
        <a href="<?= HTTP_HOST ?>/blog/search?q=<?= $params['query'] ?>&p=<?= $i ?>"><?= $i ?></a>
    <?php
    }
    if ($params['currentPage'] < $params['requiredPages']) {
    ?>
        <a href="<?= HTTP_HOST ?>/blog/search?q=<?= $params['query'] ?>&p=<?= $params['currentPage'] + 1 ?>">Next</a>
    <?php
    }
    ?>
</div>