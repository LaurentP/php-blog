<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= HTTP_HOST ?>/asset/css/style.css">
    <title>Admin - <?= SITE_NAME ?></title>
</head>

<body>

    <div class="login">

        <h1>Login</h1>

        <?php if ($params['error'] !== null): ?>
            <div class="text-error">
                <p><?= $params['error'] ?></p>
            </div>
        <?php endif; ?>

        <form method="post">

            <p>
                <label for="username">Username</label>
            </p>
            <p>
                <input type="text" name="username" id="username" required>
            </p>

            <p>
                <label for="password">Password</label>
            </p>
            <p>
                <input type="password" name="password" id="password" required>
            </p>

            <button type="submit" class="btn">Login</button>

        </form>

    </div>

</body>

</html>