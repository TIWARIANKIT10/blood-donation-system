<?php
session_start();

// Destroy all session variables
session_unset();
session_destroy();

// Redirect to index page
header("Location: index.php");
exit();
?>
