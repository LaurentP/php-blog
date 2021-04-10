<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/admin/layout.php';

$pageTitle = 'Admin';

?>

<h1>Posts</h1>

<div class="table-container">
    <table class="table">
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
                            <span class="badge-on">Online</span>
                        <?php else : ?>
                            <span class="badge-off">Offline</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <ul class="table-action">
                            <li><i class="icon icon-visibility"></i> <a href="<?= HTTP_HOST ?>/admin/post/preview/<?= $post->getId() ?>">Preview</a></li>
                            <li><i class="icon icon-edit"></i> <a href="<?= HTTP_HOST ?>/admin/post/edit/<?= $post->getId() ?>">Edit</a></li>
                            <li><i class="icon icon-clear"></i> <a href="<?= HTTP_HOST ?>/admin/post/delete/<?= $post->getId() ?>">Delete</a></li>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<nav class="pagination">
    <ul>
        <?php
        if ($params['currentPage'] > 1) {
        ?>
            <li><a href="<?= HTTP_HOST ?>/admin/post/<?= $params['currentPage'] - 1 ?>">&laquo; Prev</a></li>
            <?php
        }

        for ($i = 1; $i <= $params['requiredPages']; $i++) {

            if ($params['currentPage'] === $i) {
            ?>
                <li><a href="<?= HTTP_HOST ?>/admin/post/<?= $i ?>" class="pagination-active"><?= $i ?></a></li>
            <?php
            } else {
            ?>
                <li><a href="<?= HTTP_HOST ?>/admin/post/<?= $i ?>"><?= $i ?></a></li>
            <?php
            }
        }

        if ($params['currentPage'] < $params['requiredPages']) {
            ?>
            <li><a href="<?= HTTP_HOST ?>/admin/post/<?= $params['currentPage'] + 1 ?>">Next &raquo;</a></li>
        <?php
        }
        ?>
    </ul>
</nav>