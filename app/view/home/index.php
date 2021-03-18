<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/layout.php';

$pageTitle = 'Home';

?>

<h2>Home</h2>

<h3>Latest posts</h3>

<?php
foreach ($params['latestPosts'] as $post) {
    $image = pathinfo($post->getImage(), PATHINFO_FILENAME) . '-min.' . pathinfo($post->getImage(), PATHINFO_EXTENSION);
    if (strlen($post->getContent()) > 100) {
        $content = substr($post->getContent(), 0, 100) . '...';
    } else {
        $content = $post->getContent();
    }
?>
    <div>
    <h4><?= $post->getTitle() ?></h4>
        <time><?= $post->getCreatedAt() ?></time>
        <?php
        if ($post->getImage() !== '') {
            $imagePath = ROOT_DIRECTORY . '/public/upload/post/' . $post->getImage();
            if (file_exists($imagePath)) {
                ?><img src="http://<?= HTTP_HOST . '/upload/post/' . $post->getImage() ?>" alt="<?= $post->getTitle() ?>"><?php
            }
        }
        ?>
        <p><?= $post->getContent() ?></p>
        <a href="./post/<?= $post->getSlug() . '-' . $post->getId() ?>">Read</a>
    </div>
<?php
}
?>

<div>
    <p><a href="http://<?= HTTP_HOST ?>/blog">View all</a></p>
</div>