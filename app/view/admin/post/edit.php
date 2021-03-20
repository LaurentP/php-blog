<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/admin/layout.php';

$pageTitle = 'Edit post';

?>

<h1>Edit post</h1>

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
        <input type="text" name="title" id="title" value="<?= $params['post']->getTitle() ?>" required>
    </p>

    <p>
        <label for="title">Slug</label>
    </p>
    <p>
        <input type="text" name="slug" id="slug" value="<?= $params['post']->getSlug() ?>" required>
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
        <textarea name="content" id="content" cols="30" rows="10" required><?= $params['post']->getContent() ?></textarea>
    </p>

    <p>
        <label for="enabled">Online</label>
        <input type="checkbox" name="enabled" id="enabled" <?= $params['post']->getEnabled() === true ? ' checked' : '' ?>>
    </p>

    <button type="submit" class="btn">Edit</button>

</form>