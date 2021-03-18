<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/admin/layout.php';

$pageTitle = 'Admin';

?>

<h2>Admin</h2>

<a href="http://<?= HTTP_HOST ?>/admin/post/new">New post</a>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Image</th>
            <th>Content</th>
            <th>Created at</th>
            <th>Enabled</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php
        foreach ($params['postList'] as $post) {
            $image = pathinfo($post->getImage(), PATHINFO_FILENAME) . '-min.' . pathinfo($post->getImage(), PATHINFO_EXTENSION);
            if (strlen($post->getContent()) > 100) {
                $content = substr($post->getContent(), 0, 100) . '...';
            } else {
                $content = $post->getContent();
            }
        ?>
            <tr>
                <td><?= $post->getId() ?></td>
                <td><?= $post->getTitle() ?></td>
                <td>
                    <?php
                    if ($post->getImage() !== '') {
                        $imagePath = ROOT_DIRECTORY . '/public/upload/post/' . $post->getImage();
                        if (file_exists($imagePath)) {
                            ?><img src="http://<?= HTTP_HOST . '/upload/post/' . $post->getImage() ?>" alt="<?= $post->getTitle() ?>"><?php
                        }
                    }
                    ?>
                </td>
                <td><?= $post->getContent() ?></td>
                <td><?= $post->getCreatedAt() ?></td>
                <td><?= $post->getEnabled() ?></td>
                <td>
                    <a href="http://<?= HTTP_HOST ?>/post/<?= $post->getSlug() . '-' . $post->getId() ?>">Read</a>
                    <a href="http://<?= HTTP_HOST ?>/admin/post/edit/<?= $post->getId() ?>">Edit</a>
                    <a href="http://<?= HTTP_HOST ?>/admin/post/delete/<?= $post->getId() ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>

    </tbody>
</table>

<div>
    <?php
    if ($params['currentPage'] > 1) {
    ?>
        <a href="http://<?= HTTP_HOST ?>/admin/<?= $params['currentPage'] - 1 ?>">Prev</a>
    <?php
    }
    for ($i = 1; $i <= $params['requiredPages']; $i++) {
    ?>
        <a href="http://<?= HTTP_HOST ?>/admin/<?= $i ?>"><?= $i ?></a>
    <?php
    }
    if ($params['currentPage'] < $params['requiredPages']) {
    ?>
        <a href="http://<?= HTTP_HOST ?>/admin/<?= $params['currentPage'] + 1 ?>">Next</a>
    <?php
    }
    ?>
</div>
