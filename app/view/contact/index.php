<?php

$pageTitle = 'Contact';

ob_start();

?>

<h2>Contact</h2>

<?php if ($params['result'] !== null):
    $alertType = array_keys($params['result'])[0];
?>
    <div>
        <p><?= $params['result'][$alertType] ?></p>
    </div>
<?php endif; ?>

<form method="post">

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

    <input type="hidden" name="hp">

    <button type="submit">Send</button>

</form>

<?php

$content = ob_get_clean();

require_once dirname(__DIR__) . '/layout.php';
