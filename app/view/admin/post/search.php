<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/admin/layout.php';

$pageTitle = 'Admin';

?>

<h1>Posts</h1>

<h2>Search results : <?= $params['count'] ?> found</h2>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($params['postList'] as $post) : ?>
            <tr>
                <td><strong><?= $post->getTitle() ?></strong></td>
                <td><?= date('F j, Y, g:i A', strtotime($post->getCreatedAt())) ?></td>
                <td>
                    <?php if ($post->getEnabled()) : ?>
                        <span class="text-success">Online</span>
                    <?php else : ?>
                        <span class="text-error">Offline</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= HTTP_HOST ?>/post/<?= $post->getSlug() . '-' . $post->getId() ?>">Read</a>
                    <a href="<?= HTTP_HOST ?>/admin/post/edit/<?= $post->getId() ?>">Edit</a>
                    <a href="<?= HTTP_HOST ?>/admin/post/delete/<?= $post->getId() ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>

<div class="pagination">
    <?php
    if ($params['currentPage'] > 1) {
    ?>
        <a href="<?= HTTP_HOST ?>/admin/post/search?q=<?= $params['query'] ?>&p=<?= $params['currentPage'] - 1 ?>">Prev</a>
    <?php
    }
    for ($i = 1; $i <= $params['requiredPages']; $i++) {
    ?>
        <a href="<?= HTTP_HOST ?>/admin/post/search?q=<?= $params['query'] ?>&p=<?= $i ?>"><?= $i ?></a>
    <?php
    }
    if ($params['currentPage'] < $params['requiredPages']) {
    ?>
        <a href="<?= HTTP_HOST ?>/admin/post/search?q=<?= $params['query'] ?>&p=<?= $params['currentPage'] + 1 ?>">Next</a>
    <?php
    }
    ?>
</div>