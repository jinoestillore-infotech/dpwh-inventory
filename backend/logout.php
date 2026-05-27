<?php
session_start();

$_SESSION = [];

session_destroy();

header("Location: /DPWH-SITE/index.php?success=You have logged out successfully.");
exit();
?>