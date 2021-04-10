<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/admin/layout.php';

$pageTitle = 'Edit post';

?>

<h1>Edit post</h1>

<?php if ($params['error'] !== null) : ?>
    <div class="alert-error">
        <p><?= $params['error'] ?></p>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title" class="form-label">Title</label>
        <input class="form-control" type="text" name="title" id="title" value="<?= $params['post']->getTitle() ?>" required>
    </div>
    <div class="form-group">
        <label for="slug" class="form-label">Slug</label>
        <input class="form-control" type="text" name="slug" id="slug" value="<?= $params['post']->getSlug() ?>" required>
    </div>
    <div class="form-group">
        <label for="imageFileInput" class="form-label">Image</label>
        <div class="image-preview">
            <script>
                let imageIsDisplayed = false
            </script>
            <?php
            if ($params['post']->getImageThumb() !== '') {
                $imagePath = ROOT_DIRECTORY . '/public/upload/post/' . $params['post']->getImageThumb();
                if (file_exists($imagePath)) {
            ?>
                    <img src="<?= HTTP_HOST . '/upload/post/' . $params['post']->getImageThumb() ?>" alt="">
                    <br><br><a href="#" class="image-preview-delete">Delete</a><br><br>
                    <script>
                        imageIsDisplayed = true
                    </script>
            <?php
                }
            }
            ?>
        </div>
        <label class="file-upload" for="imageFileInput">
            <span class="btn">Choose a file...</span>
            <input type="file" name="image" id="imageFileInput" accept="image/gif, image/jpeg, image/png">
            &nbsp;<span class="file-upload-text">No file chosen</span>
        </label>
    </div>
    <div class="form-group">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" name="content" id="content" cols="30" rows="10" required><?= $params['post']->getContent() ?></textarea>
    </div>
    <div class="form-group">
        <input type="checkbox" name="enabled" id="enabled" <?= $params['post']->getEnabled() === true ? ' checked' : '' ?>> <label for="enabled">Online</label>
    </div>
    <input type="hidden" name="csrf_token" value="<?= $params['csrf_token'] ?>">
    <div class="form-footer">
        <button class="btn" type="submit">Update</button>
    </div>
</form>