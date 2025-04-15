<?php
session_start();
include('../db.php'); // подключение к базе данных

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Проверка в таблице admins
    $stmt = $pdo->prepare("SELECT * FROM moderator WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $moderator = $stmt->fetch();

    if ($moderator && password_verify($password, $moderator['password'])) {
        $_SESSION['moderator_id'] = $moderator['id'];
        header('Location: dashboard.php');

        exit;
    } else {
        echo "Неверный логин или пароль!";
    }
}
?>
