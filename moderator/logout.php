<?php
session_start();
session_unset();
session_destroy();
header('Location: /moderator/moderator_login.php');
exit;
?>
