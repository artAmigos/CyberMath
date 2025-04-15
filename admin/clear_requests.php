<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/admin_login.php');
    exit;
}

$pdo->query("DELETE FROM moderator_requests");

header("Location: dashboard.php");
exit;
?>
