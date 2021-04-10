<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?= SITE_NAME ?></title>
    <link rel="stylesheet" href="<?= HTTP_HOST ?>/assets/css/style.css">
</head>

<body>

    <div class="login-box">

        <h1>Login</h1>

        <?php if ($params['error'] !== null) : ?>
            <div class="alert-error">
                <p><?= $params['error'] ?></p>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input class="form-control" type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input class="form-control" type="password" name="password" id="password" required>
            </div>
            <button class="btn" type="submit">Sign in</button>

        </form>

    </div>

</body>

</html>