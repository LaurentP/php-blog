<?php

$pageLayout = ROOT_DIRECTORY . '/app/view/layout.php';

$pageTitle = 'Contact';

?>

<h1>Contact</h1>

<?php if ($params['result'] !== null):
    $alertType = array_keys($params['result'])[0];
?>
    <div>
        <p><?= $params['result'][$alertType] ?></p>
    </div>
<?php endif; ?>

<form class="contact-form" method="post">

    <p>
        <label for="fullname">Name</label>
    </p>
    <p>
        <input type="text" name="fullname" id="fullname" required>
    </p>

    <p>
        <label for="email">Email</label>
    </p>
    <p>
        <input type="email" name="email" id="email" required>
    </p>

    <p>
        <label for="message">Message</label>
    </p>
    <p>
        <textarea name="message" id="message" cols="30" rows="10" required></textarea>
    </p>

    <input type="hidden" name="hp_check">

    <button type="submit" class="btn">Send</button>

</form>