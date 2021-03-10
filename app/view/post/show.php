<?php

$pageTitle = $params['post']->getTitle();

ob_start();

?>

<article>
    <h2><?= $params['post']->getTitle() ?></h2>
    <time><?= $params['post']->getCreatedAt() ?><time>
    <?php
    $imageDir = dirname(__DIR__, 3) . '/public/upload/post/';
    $imagePath = $imageDir . $params['post']->getImage();
    if ($imagePath !== $imageDir && file_exists($imagePath)) {
        ?><img src="http://<?= HTTP_HOST . '/upload/post/' . $params['post']->getImage() ?>" alt="<?= $params['post']->getTitle() ?>"><?php
    }
    ?>
    <p><?= $params['post']->getContent() ?></p>
</article>

<?php

$content = ob_get_clean();

require_once dirname(__DIR__) . '/layout.php';
