<?php
session_start();
require_once '../../db.php';  // Подключаем БД

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль - CyberMath</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Rubik', sans-serif;
            background-color: #fff;
            color: #333;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        .profile-box {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 60px 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            z-index: 2;
            position: relative;
        }

        .profile-box h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
        }

        .profile-box p {
            font-size: 1rem;
            color: #555;
        }

        .btn-primary {
            background-color: #04a3ff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #038ad1;
        }

        /* Летающие смайлики и ракеты */
        .smiley, .rocket {
            position: absolute;
            font-size: 30px;
            opacity: 0;
            animation: fly 10s infinite, fadeIn 1s forwards;
        }

        .smiley {
            animation-delay: calc(0.5s * var(--index));
        }

        .rocket {
            font-size: 40px;
            animation-delay: calc(2s + 0.5s * var(--index));
        }

        /* Анимация полета */
        @keyframes fly {
            0% {
                transform: translateY(0) translateX(0);
            }
            100% {
                transform: translateY(-100vh) translateX(100vw);
            }
        }

        /* Анимация плавного появления */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 0.8;
            }
        }

        /* Рандомизация позиции */
        .smiley:nth-child(odd) {
            font-size: 35px;
            color: #ffcc00;
        }

        .smiley:nth-child(even) {
            font-size: 40px;
            color: #ff6699;
        }

        .rocket {
            color: #00bfff;
        }

        @media (max-width: 480px) {
            .profile-box {
                padding: 50px 20px;
            }

            .profile-box h1 {
                font-size: 1.7rem;
            }
        }
    </style>
</head>
<body>
    <!-- Летающие смайлики и ракеты с рандомизацией -->
    <div class="smiley" style="left: 10%; top: 20%; --index: 1;">😊</div>
    <div class="smiley" style="left: 30%; top: 50%; --index: 2;">😎</div>
    <div class="smiley" style="left: 60%; top: 10%; --index: 3;">😄</div>
    <div class="smiley" style="left: 80%; top: 70%; --index: 4;">😁</div>
    <div class="rocket" style="left: 5%; top: 80%; --index: 5;">🚀</div>
    <div class="rocket" style="left: 70%; top: 40%; --index: 6;">🚀</div>
    <div class="rocket" style="left: 50%; top: 90%; --index: 7;">🚀</div>

    <div class="profile-box">
        <h1>Привет, <?php echo $user['name']; ?>!</h1>
        <p>Email: <?php echo $user['email']; ?></p>
        <p>Дата регистрации: <?php echo $user['created_at']; ?></p>
        <p>Баланс: <?php echo $user['coins']; ?> монет</p>
        <a href="logout.php" class="btn btn-primary">Выйти</a>
    </div>
</body>
</html>
