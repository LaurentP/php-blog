<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/layout.php';

$pageTitle = 'Contact';

?>

<h1>Contact</h1>

<?php if ($params['result'] !== null) :
    $alertType = array_keys($params['result'])[0];
?>
    <div class="alert-<?= $alertType ?>">
        <p><?= $params['result'][$alertType] ?></p>
    </div>
<?php endif; ?>

<form method="POST">
    <div class="form-group">
        <label for="fullname" class="form-label">Name</label>
        <input class="form-control" type="text" name="fullname" id="fullname" required>
    </div>
    <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input class="form-control" type="email" name="email" id="email" required>
    </div>
    <div class="form-group">
        <label for="textarea" class="form-label">Message</label>
        <textarea class="form-control" name="message" id="textarea" cols="30" rows="10" required></textarea>
    </div>
    <input type="hidden" name="hp_check">
    <div class="form-footer">
        <button class="btn" type="submit">Submit</button>
    </div>
</form>