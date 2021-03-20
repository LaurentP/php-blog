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
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <div class="navbar-menu">
                <a href="<?= HTTP_HOST ?>/">Home</a>
                <a href="<?= HTTP_HOST ?>/blog">Blog</a>
                <a href="<?= HTTP_HOST ?>/contact">Contact</a>
                <a href="<?= HTTP_HOST ?>/admin">Admin</a>
                <?php if (isset($_SESSION['admin'])) : ?>
                    <a href="<?= HTTP_HOST ?>/admin/logout">Logout</a>
                <?php endif; ?>
                <form action="<?= HTTP_HOST ?>/blog/search" method="get">
                    <input type="text" name="q" placeholder="Search...">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
        </nav>
    </header>

    <main class="container">
        <?= $pageContent ?>
    </main>

</body>

</html>