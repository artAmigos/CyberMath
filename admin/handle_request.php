<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/admin_login.php');
    exit;
}

$request_id = $_POST['request_id'];
$action = $_POST['action'];
$target_name = $_POST['target_name'];
$coins = $_POST['coins'];

if (isset($_POST['do_action'])) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name = ?");
    $stmt->execute([$target_name]);
    $user = $stmt->fetch();

    if ($user) {
        if ($action == 'give_coins') {
            $pdo->prepare("UPDATE users SET coins = coins + ? WHERE name = ?")->execute([$coins, $target_name]);
        } elseif ($action == 'block_user') {
            $pdo->prepare("UPDATE users SET status = 'blocked' WHERE name = ?")->execute([$target_name]);
        } elseif ($action == 'delete_user') {
            $pdo->prepare("DELETE FROM users WHERE name = ?")->execute([$target_name]);
        }
    }
}

$pdo->prepare("DELETE FROM moderator_requests WHERE id = ?")->execute([$request_id]);

header("Location: dashboard.php");
exit;
?>
