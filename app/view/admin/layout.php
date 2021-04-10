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
                    <li><a href="<?= HTTP_HOST ?>/admin/post/new">New post</a></li>
                    <li><a href="<?= HTTP_HOST ?>/admin">Posts</a></li>
                    <li><a href="<?= HTTP_HOST ?>/admin/logout">Logout</a></li>
                </ul>
                <form action="<?= HTTP_HOST ?>/admin/post/search" method="GET" class="navbar-search">
                    <input type="text" name="q" placeholder="Search..." class="form-control">
                    <button type="submit" class="btn"></button>
                </form>
            </div>

        </nav>

    </header>

    <div class="container">
        <?= $pageContent ?>
    </div>

    <script src="<?= HTTP_HOST ?>/assets/js/app.js"></script>
</body>

</html>