<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/admin/layout.php';

$pageTitle = 'Delete post';

?>

<h1>Delete post</h1>

<h3><?= $params['post']->getTitle() ?></h3>
<time class="date"><?= date('F j, Y, g:i A', strtotime($params['post']->getCreatedAt())) ?></time>

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

<?php if ($params['error'] !== null) : ?>
    <div class="alert-error">
        <p><?= $params['error'] ?></p>
    </div>
<?php endif; ?>

<form method="POST">
    <input type="hidden" name="delete" value="true">
    <input type="hidden" name="csrf_token" value="<?= $params['csrf_token'] ?>">
    <div class="form-footer">
        <button type="submit" class="btn">Delete</button>
    </div>
</form>