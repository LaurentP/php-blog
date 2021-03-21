<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/admin/layout.php';

$pageTitle = 'New post';

?>

<h1>New post</h1>

<?php if ($params['error'] !== null): ?>
    <div>
        <p><?= $params['error'] ?></p>
    </div>
<?php endif; ?>

<form class="post-form" method="post" enctype="multipart/form-data">

    <p>
        <label for="title">Title</label>
    </p>
    <p>
        <input type="text" name="title" id="title" required>
    </p>

    <p>
        <label for="image">Image</label>
    </p>
    <p>
        <input type="file" name="image" id="image">
    </p>

    <p>
        <label for="content">Content</label>
    </p>
    <p>
        <textarea name="content" id="content" cols="30" rows="10" required></textarea>
    </p>

    <p>
        <label for="enabled">Online</label>
        <input type="checkbox" name="enabled" id="enabled" checked>
    </p>

    <input type="hidden" name="csrf_token" value="<?= $params['csrf_token'] ?>">

    <button type="submit" class="btn">Post</button>

</form>
