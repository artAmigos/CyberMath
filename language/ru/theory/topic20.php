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
    <title>Введение в вероятность - CyberMath</title>
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
        
        .probability-box {
            background-color: #f8f9fa;
            border-left: 4px solid #6c5ce7;
            padding: 15px;
            margin: 15px 0;
            border-radius: 0 5px 5px 0;
        }
        
        .example-img {
            max-width: 300px;
            margin: 15px auto;
            display: block;
        }
    </style>
</head>
<body class="container py-5 position-relative">


    <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="emoji" style="left: <?= rand(0, 100) ?>%; top: <?= rand(10, 100) ?>px; animation-delay: <?= rand(0, 10) ?>s;">
            <?= ['🎲','📊','🎯','🧮','🔮','📈','🎰','🤔'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

    <div class="card mx-auto" style="max-width: 900px;">
        <h1 class="mb-4 text-center">🎲 Введение в вероятность</h1>

        <p><strong>Вероятность</strong> — это числовая характеристика возможности наступления какого-либо события. Она измеряется от 0 (невозможное событие) до 1 (достоверное событие) или от 0% до 100%.</p>

        <div class="probability-box">
            <strong>Формула вероятности:</strong><br>
            P(A) = Число благоприятных исходов / Общее число возможных исходов<br>
            Где P(A) — вероятность события A
        </div>

        <h3 class="mt-4">🔹 Основные понятия</h3>
        <ul>
            <li><strong>Достоверное событие</strong> — событие, которое обязательно произойдет (P = 1)</li>
            <li><strong>Невозможное событие</strong> — событие, которое никогда не произойдет (P = 0)</li>
            <li><strong>Случайное событие</strong> — событие, которое может произойти, а может и не произойти (0 < P < 1)</li>
        </ul>

        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Probability_scale.png/300px-Probability_scale.png" alt="Шкала вероятностей" class="example-img">

        <h3 class="mt-4">🎯 Примеры вероятностей</h3>
        <div class="alert alert-success">
            <strong>Пример 1:</strong> Вероятность выпадения орла при подбрасывании монеты<br>
            P = 1/2 = 0.5 (или 50%)
        </div>

        <div class="alert alert-warning">
            <strong>Пример 2:</strong> Вероятность выпадения 6 на игральном кубике<br>
            P = 1/6 ≈ 0.1667 (или ≈16.67%)
        </div>

        <div class="alert alert-info">
            <strong>Пример 3:</strong> Вероятность вытащить туза из колоды в 36 карт<br>
            P = 4/36 = 1/9 ≈ 0.1111 (или ≈11.11%)
        </div>

        <h3 class="mt-4">📊 Где применяется вероятность?</h3>
        <ul>
            <li>В азартных играх и лотереях</li>
            <li>В страховании и финансах</li>
            <li>В прогнозировании погоды</li>
            <li>В медицине и биологии</li>
            <li>В компьютерных алгоритмах</li>
        </ul>

        <div class="probability-box mt-4">
            <strong>Совет:</strong> Вероятность можно выражать как дробью (1/6), так и десятичной дробью (0.1667) или процентами (16.67%). Все три формы равноправны.
        </div>

        <p class="text-center mt-4">
            <a href="../tasks/topic20.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
        </p>
    </div>
</body>
</html>