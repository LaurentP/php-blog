<?php

$pageTitle = 'Admin';

ob_start();

?>

<h2>Admin</h2>

<?php

$content = ob_get_clean();

require_once 'layout.php';