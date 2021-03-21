<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/layout.php';

$pageTitle = 'Home';

?>

<h1>Home</h1>

<h2>Latest posts</h2>

<?php foreach ($params['latestPosts'] as $post) : ?>
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
        <a href="./post/<?= $post->getSlug() . '-' . $post->getId() ?>">Read</a>
    </div>
<?php endforeach; ?>

<div>
    <p><a href="<?= HTTP_HOST ?>/blog">View all</a></p>
</div>