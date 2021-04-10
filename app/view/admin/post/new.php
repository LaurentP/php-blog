<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/admin/layout.php';

$pageTitle = 'New post';

?>

<h1>New post</h1>

<?php if ($params['error'] !== null) : ?>
    <div class="alert-error">
        <p><?= $params['error'] ?></p>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title" class="form-label">Title</label>
        <input class="form-control" type="text" name="title" id="title" required>
    </div>
    <div class="form-group">
        <label for="imageFileInput" class="form-label">Image</label>
        <div class="image-preview"></div>
        <label class="file-upload" for="imageFileInput">
            <span class="btn">Choose a file...</span>
            <input type="file" name="image" id="imageFileInput" accept="image/gif, image/jpeg, image/png">
            &nbsp;<span class="file-upload-text">No file chosen</span>
        </label>
    </div>
    <div class="form-group">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" name="content" id="content" cols="30" rows="10" required></textarea>
    </div>
    <div class="form-group">
        <input type="checkbox" name="enabled" id="enabled" checked> <label for="enabled">Online</label>
    </div>
    <input type="hidden" name="csrf_token" value="<?= $params['csrf_token'] ?>">
    <div class="form-footer">
        <button class="btn" type="submit">Save</button>
    </div>
</form>