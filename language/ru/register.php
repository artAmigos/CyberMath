<?php
session_start();
require_once '../../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $passwordRaw = $_POST['password'];

    if (strlen($passwordRaw) < 8 || !preg_match('/[A-Za-z]/', $passwordRaw) || !preg_match('/[0-9]/', $passwordRaw)) {
        $error = "Пароль должен содержать минимум 8 символов, включая буквы и цифры.";
    } else {
        $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR name = ?");
        $stmt->execute([$email, $name]);
        $user = $stmt->fetch();

        if ($user) {
            if ($user['email'] === $email) {
                $error = "Пользователь с таким email уже существует.";
            } elseif ($user['name'] === $name) {
                $error = "Пользователь с таким именем уже существует.";
            } else {
                $error = "Такой пользователь уже зарегистрирован.";
            }
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $password]);

            // Автоматический вход
            $_SESSION['user_id'] = $pdo->lastInsertId();
            header("Location: profile.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация - CyberMath</title>
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
            background-color: #181818;
            color: #fff;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-box {
            background: #111;
            border: 1px solid #222;
            padding: 60px 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.04);
            z-index: 2;
            position: relative;
        }

        .login-box h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #fff;
        }

        .tagline {
            font-size: 0.95rem;
            color: #aaa;
            margin-bottom: 30px;
        }

        .form-control {
            background-color: #222;
            border: 1px solid #333;
            color: #fff;
            border-radius: 10px;
            padding: 12px 15px;
        }

        .form-control::placeholder {
            color: #888;
        }

        .form-control:focus {
            border-color: #555;
            background-color: #222;
            box-shadow: none;
            color: #fff;
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

        .error-msg {
            color: #ff5e5e;
            margin-bottom: 15px;
        }

        .success-msg {
            color: #62ff62;
            margin-bottom: 15px;
        }

        @media (max-width: 480px) {
            .login-box {
                padding: 50px 20px;
            }

            .login-box h1 {
                font-size: 1.7rem;
            }

            .tagline {
                font-size: 0.85rem;
            }
        }

        .emoji {
            position: absolute;
            font-size: 40px;
            opacity: 0.15;
            animation: floatUp 15s linear infinite;
        }

        .emoji:nth-child(1) { top: 100%; left: 10%; animation-delay: 0s; }
        .emoji:nth-child(2) { top: 100%; left: 30%; animation-delay: 3s; }
        .emoji:nth-child(3) { top: 100%; left: 50%; animation-delay: 6s; }
        .emoji:nth-child(4) { top: 100%; left: 70%; animation-delay: 1.5s; }
        .emoji:nth-child(5) { top: 100%; left: 90%; animation-delay: 4.5s; }

        @keyframes floatUp {
            0% { transform: translateY(0) scale(1) rotate(0deg); opacity: 0.15; }
            50% { opacity: 0.3; }
            100% { transform: translateY(-120vh) scale(1.2) rotate(360deg); opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="emoji">🎉</div>
    <div class="emoji">✨</div>
    <div class="emoji">🚀</div>
    <div class="emoji">😎</div>
    <div class="emoji">🔥</div>

    <div class="login-box">
        <h1>Регистрация</h1>
        <p class="tagline">Создайте аккаунт для CyberMath</p>

        <?php if (!empty($error)): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php elseif (!empty($success)): ?>
            <div class="success-msg"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Имя" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Пароль" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
        </form>

        <div class="mt-3">
            Уже есть аккаунт? <a href="login.php">Войти</a>
        </div>
    </div>
</body>
</html>
