<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/layout.php';

$pageTitle = $params['post']->getTitle();

?>

<article>
    <h1><?= $params['post']->getTitle() ?></h1>
    <time><?= date('F j, Y, g:i A', strtotime($params['post']->getCreatedAt())) ?><time>
    <?php
    $imageDir = ROOT_DIRECTORY . '/public/upload/post/';
    $imagePath = $imageDir . $params['post']->getImage();
    if ($imagePath !== $imageDir && file_exists($imagePath)) {
        ?><img src="<?= HTTP_HOST . '/upload/post/' . $params['post']->getImage() ?>" alt="<?= $params['post']->getTitle() ?>"><?php
    }
    ?>
    <p><?= $params['post']->getContent() ?></p>
</article>