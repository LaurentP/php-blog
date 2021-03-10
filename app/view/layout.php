<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://<?= HTTP_HOST ?>/asset/css/style.css">
    <title><?= $pageTitle . ' - ' . SITE_NAME ?? SITE_NAME ?></title>
</head>
<body>
    
    <header>
        <h1><?= SITE_NAME ?></h1>
        <nav>
            <a href="http://<?= HTTP_HOST ?>/">Home</a>
            <a href="http://<?= HTTP_HOST ?>/blog">Blog</a>
            <a href="http://<?= HTTP_HOST ?>/contact">Contact</a>
            <a href="http://<?= HTTP_HOST ?>/admin">Admin</a>
            <?php
                if (isset($_SESSION['admin'])) {
                    ?>
                        <a href="http://<?= HTTP_HOST ?>/admin/logout">Logout</a>
                    <?php
                }
            ?>
        </nav>
    </header>

    <main>
        <?= $content ?>
    </main>

</body>
</html>