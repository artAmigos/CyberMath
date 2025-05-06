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
    <title>Типы чисел - CyberMath</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            position: relative;
            overflow-x: hidden;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2d3436;
        }

        .card {
            background: #ffffffdd;
            border: none;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .emoji {
            position: absolute;
            font-size: 2rem;
            animation: float 12s infinite linear;
            opacity: 0.8;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% { opacity: 0.9; }
            100% {
                transform: translateY(-200px) rotate(360deg);
                opacity: 0;
            }
        }

        .btn-primary {
            background-color: #00b894;
            border: none;
        }

        .btn-primary:hover {
            background-color: #00a383;
        }
    </style>
</head>
<body class="container py-5 position-relative">

    <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="emoji" style="left: <?= rand(0, 100) ?>%; top: <?= rand(50, 500) ?>px; animation-delay: <?= rand(0, 10) ?>s;">
            <?= ['🔢','🔍','📘','➗','➕','🧠','📚','💡'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

    <div class="card mx-auto" style="max-width: 900px;">
    <h1 class="mb-4 text-center">📘 Натуральные, целые, рациональные и иррациональные числа</h1>

    <p><strong>Натуральные числа</strong> — это положительные целые числа, которые мы используем при счёте: 1, 2, 3, 4, ...</p>

    <p><strong>Целые числа</strong> — это натуральные числа, ноль и их отрицательные аналоги: ..., -3, -2, -1, 0, 1, 2, 3, ...</p>

    <p><strong>Рациональные числа</strong> — это числа, которые можно представить в виде дроби <em>a/b</em>, где <em>a</em> и <em>b</em> — целые числа, а <em>b ≠ 0</em>. Примеры: 1/2, -3, 0.75</p>

    <p><strong>Иррациональные числа</strong> — это числа, которые <em>нельзя</em> представить в виде дроби. Они имеют бесконечную непериодическую десятичную запись. Примеры: √2, π</p>

    <div class="alert alert-success">
        💡 Пример:  
        <ul>
            <li>5 — натуральное, целое и рациональное</li>
            <li>-7 — целое и рациональное</li>
            <li>1/3 — рациональное</li>
            <li>√2 — иррациональное</li>
        </ul>
    </div>

    <p>🧠 Совет: чтобы определить тип числа — подумай, можно ли его выразить в виде дроби, и есть ли у него конечное или бесконечное повторяющееся десятичное представление.</p>

        <p class="text-center mt-4">
            <a href="../tasks/topic3.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
        </p>
    </div>
</body>
</html>
