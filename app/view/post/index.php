<?php

$pageTitle = 'Blog';

ob_start();

?>

<h2>Blog</h2>

<?php
foreach ($params['postList'] as $post) {
    $image = pathinfo($post->getImage(), PATHINFO_FILENAME) . '-min.' . pathinfo($post->getImage(), PATHINFO_EXTENSION);
    if (strlen($post->getContent()) > 100) {
        $content = substr($post->getContent(), 0, 100) . '...';
    } else {
        $content = $post->getContent();
    }
?>
    <div>
        <h3><?= $post->getTitle() ?></h3>
        <time><?= $post->getCreatedAt() ?></time>
        <?php
        if ($post->getImage() !== '') {
            $imagePath = dirname(__DIR__, 3) . '/public/upload/post/' . $post->getImage();
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
    <p>
        <?php
        if ($params['currentPage'] > 1) {
        ?>
            <a href="./<?= $params['currentPage'] - 1 ?>">Prev</a>
        <?php
        }
        for ($i = 1; $i <= $params['requiredPages']; $i++) {
        ?>
            <a href="./<?= $i ?>"><?= $i ?></a>
        <?php
        }
        if ($params['currentPage'] < $params['requiredPages']) {
        ?>
            <a href="./<?= $params['currentPage'] + 1 ?>">Next</a>
        <?php
        }
        ?>
    </p>
</div>
<?php

$content = ob_get_clean();

require_once dirname(__DIR__) . '/layout.php';
