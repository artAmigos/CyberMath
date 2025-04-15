<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['moderator_id'])) {
    header('Location: moderator_login.php');
    exit;
}

$moderator_id = $_SESSION['moderator_id'];
$target_name = $_POST['target_name'];
$action = $_POST['action'];
$coins = $_POST['coins'] ?? 0;
$note = $_POST['note'] ?? '';

$stmt = $pdo->prepare("INSERT INTO moderator_requests (moderator_id, target_name, action, coins, note) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$moderator_id, $target_name, $action, $coins, $note]);

header("Location: dashboard.php?success=1");
exit;
?>
