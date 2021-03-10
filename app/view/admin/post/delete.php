<?php

$pageTitle = 'Delete post';

ob_start();

?>

<h2>Delete post</h2>

<h3><?= $params['post']->getTitle() ?></h3>
<p><?= $params['post']->getCreatedAt() ?></p>
<?php
if ($params['post']->getImage() !== '') {
    $imagePath = dirname(__DIR__, 4) . '/public/upload/post/' . $params['post']->getImage();
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

<?php

$content = ob_get_clean();

require_once dirname(__DIR__) . '/layout.php';
