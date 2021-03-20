<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= HTTP_HOST ?>/asset/css/style.css">
    <title><?= $pageTitle . ' - ' . SITE_NAME ?? SITE_NAME ?></title>
</head>

<body>

    <header>
        <nav class="navbar">
            <div class="navbar-brand">
                <a href="<?= HTTP_HOST ?>/">PHP Blog</a>
            </div>
            <div class="navbar-button" tabindex="0">
                Menu
            </div>
            <div class="navbar-menu">
                <a href="<?= HTTP_HOST ?>/admin/post/new">New post</a>
                <a href="<?= HTTP_HOST ?>/admin">Admin</a>
                <a href="<?= HTTP_HOST ?>/admin/logout">Logout</a>
                <form action="<?= HTTP_HOST ?>/admin/post/search" method="get">
                    <input type="text" name="q" placeholder="Search...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
        </nav>
    </header>

    <div class="container">
        <?= $pageContent ?>
    </div>

</body>

</html>