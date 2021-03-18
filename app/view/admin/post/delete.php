<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/admin/layout.php';

$pageTitle = 'Delete post';

?>

<h2>Delete post</h2>

<h3><?= $params['post']->getTitle() ?></h3>
<p><?= $params['post']->getCreatedAt() ?></p>
<?php
if ($params['post']->getImage() !== '') {
    $imagePath = ROOT_DIRECTORY . '/public/upload/post/' . $params['post']->getImage();
    if (file_exists($imagePath)) {
        ?><img src="http://<?= HTTP_HOST . '/upload/post/' . $params['post']->getImage() ?>" alt="<?= $params['post']->getTitle() ?>"><?php
    }
}
?>
<p><?= $params['post']->getContent() ?></p>

<form method="post">

    <input type="hidden" name="delete" value="true">

    <button type="submit">Delete</button>

</form>