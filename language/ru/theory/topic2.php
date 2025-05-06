<?php
session_start();
require_once '../../../db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Умножение и деление - CyberMath</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            position: relative;
            overflow-x: hidden;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .card {
            background: #ffffffcc;
            border: none;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .emoji {
            position: absolute;
            font-size: 2rem;
            animation: float 10s infinite linear;
            opacity: 0.8;
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 0.8; }
            100% { transform: translateY(-200px) rotate(360deg); opacity: 0; }
        }

        .btn-primary {
            background-color: #6c5ce7;
            border: none;
        }

        .btn-primary:hover {
            background-color: #5a4bd1;
        }
    </style>
</head>
<body class="container py-5 position-relative">
    <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="emoji" style="left: <?= rand(0, 100) ?>%; top: <?= rand(10, 100) ?>px; animation-delay: <?= rand(0, 10) ?>s;">
            <?= ['✖️','➗','🧠','📘','📐','🧮','🔥','🚀'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

    <div class="card mx-auto" style="max-width: 900px;">
        <h1 class="mb-4 text-center">📘 Умножение и деление</h1>

        <p><strong>Умножение</strong> — это многократное сложение одного и того же числа. Например, 3 × 4 означает сложить 3 четыре раза: 3 + 3 + 3 + 3 = 12.</p>

        <div class="alert alert-success">
            Пример: 6 × 7 = <strong>42</strong>
        </div>

        <p>Основные свойства умножения:</p>
        <ul>
            <li><strong>Переместительное свойство:</strong> a × b = b × a</li>
            <li><strong>Сочетательное свойство:</strong> (a × b) × c = a × (b × c)</li>
        </ul>

        <p><strong>Деление</strong> — это операция, обратная умножению. Она показывает, на сколько равных частей делится число.</p>

        <div class="alert alert-warning">
            Пример: 12 ÷ 3 = <strong>4</strong>
        </div>

        <p>Если делимое меньше делителя, результат будет меньше 1 (или равен 0 в целых числах).</p>

        <p>💡 Совет: Таблица умножения — твой лучший друг! Освой её наизусть, чтобы решать задачи быстрее.</p>

        <p class="text-center mt-4">
            <a href="../tasks/topic2.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
        </p>
    </div>
</body>
</html>
