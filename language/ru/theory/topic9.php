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
    <title>Линейные уравнения - CyberMath</title>
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
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% { opacity: 0.8; }
            100% {
                transform: translateY(-200px) rotate(360deg);
                opacity: 0;
            }
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
            <?= ['🔢','✨','🧠','=','x','➕','➖','🧮'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

<div class="card mx-auto" style="max-width: 900px;">
    <h1 class="mb-4 text-center">📘 Линейные уравнения</h1>

    <p><strong>Линейное уравнение</strong> — это уравнение вида ax + b = 0, где x — переменная, a и b — коэффициенты. Решение таких уравнений — основа алгебры и необходимо для решения более сложных математических задач.</p>

    <div class="alert alert-success">
        Пример: 2x + 4 = 0 → x = <strong>-2</strong>
    </div>

    <p><strong>Алгоритм решения:</strong></p>
    <ol>
        <li>Перенести все члены с x в одну сторону, числа — в другую</li>
        <li>Привести подобные слагаемые</li>
        <li>Разделить обе части уравнения на коэффициент при x</li>
    </ol>

    <p><strong>Особые случаи:</strong></p>
    <div class="alert alert-warning">
        <ul>
            <li>Если a = 0 и b = 0 → <strong>бесконечно много решений</strong></li>
            <li>Если a = 0, а b ≠ 0 → <strong>нет решений</strong></li>
        </ul>
    </div>

    <p>🔍 Пример пошагового решения:</p>
    <p>Решим уравнение: 3x - 6 = x + 2</p>
    <ol>
        <li>Переносим: 3x - x = 2 + 6</li>
        <li>Упрощаем: 2x = 8</li>
        <li>Делим: x = 4</li>
    </ol>

    <p>📌 Где применяются:</p>
    <ul>
        <li>В физике (расчет скоростей, расстояний)</li>
        <li>В экономике (расчет прибыли, издержек)</li>
        <li>В программировании (алгоритмы, условия)</li>
        <li>В повседневной жизни (расчет времени, денег)</li>
    </ul>

    <p>🧠 Совет: Всегда проверяйте решение, подставляя найденный x обратно в уравнение!</p>

    <p class="text-center mt-4">
        <a href="../tasks/topic9.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
    </p>
</div>
</body>
</html>