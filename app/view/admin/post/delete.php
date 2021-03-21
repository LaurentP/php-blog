<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/admin/layout.php';

$pageTitle = 'Delete post';

?>

<h1>Delete post</h1>

<h3><?= $params['post']->getTitle() ?></h3>
<p><?= date('F j, Y, g:i A', strtotime($params['post']->getCreatedAt())) ?></p>
<?php
if ($params['post']->getImage() !== '') {
    $imagePath = ROOT_DIRECTORY . '/public/upload/post/' . $params['post']->getImage();
    if (file_exists($imagePath)) {
?>
        <div>
            <img src="<?= HTTP_HOST . '/upload/post/' . $params['post']->getImage() ?>" alt="<?= $params['post']->getTitle() ?>">
        </div>
<?php
    }
}
?>
<p><?= $params['post']->getContent() ?></p>

<?php if ($params['error'] !== null): ?>
    <div>
        <p><?= $params['error'] ?></p>
    </div>
<?php endif; ?>

<form method="post">

    <input type="hidden" name="delete" value="true">

    <input type="hidden" name="csrf_token" value="<?= $params['csrf_token'] ?>">

    <button type="submit" class="btn">Delete</button>

</form>