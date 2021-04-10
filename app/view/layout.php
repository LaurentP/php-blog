<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle . ' - ' . SITE_NAME ?? SITE_NAME ?></title>
    <link rel="stylesheet" href="<?= HTTP_HOST ?>/assets/css/style.css">
</head>

<body>

    <header class="header">

        <nav class="navbar">

            <a class="navbar-brand" href="<?= HTTP_HOST ?>/">PHP Blog</a>

            <div class="navbar-button"></div>
            <div class="navbar-menu">
                <ul>
                    <li><a href="<?= HTTP_HOST ?>/">Home</a></li>
                    <li><a href="<?= HTTP_HOST ?>/blog">Blog</a></li>
                    <li><a href="<?= HTTP_HOST ?>/contact">Contact</a></li>
                    <li><a href="<?= HTTP_HOST ?>/admin">Admin</a></li>
                    <?php if (isset($_SESSION['admin'])) : ?>
                    <li><a href="<?= HTTP_HOST ?>/admin/logout">Logout</a></li>
                <?php endif; ?>
                </ul>
                <form action="<?= HTTP_HOST ?>/blog/search" method="GET" class="navbar-search">
                    <input type="text" name="q" placeholder="Search..." class="form-control">
                    <button type="submit" class="btn"></button>
                </form>
            </div>

        </nav>

    </header>

    <main class="container">
        <?= $pageContent ?>
    </main>

    <footer>
        <a href="<?= HTTP_HOST ?>">PHP Blog</a>
    </footer>

    <script src="<?= HTTP_HOST ?>/assets/js/app.js"></script>
</body>

</html>