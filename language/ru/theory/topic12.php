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
    <title>Неравенства - CyberMath</title>
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
        
        .method-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .method-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="container py-5 position-relative">

    <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="emoji" style="left: <?= rand(0, 100) ?>%; top: <?= rand(10, 100) ?>px; animation-delay: <?= rand(0, 10) ?>s;">
            <?= ['≠','≤','≥','<','>','📊','🧮','🔍'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

<div class="card mx-auto" style="max-width: 900px;">
    <h1 class="mb-4 text-center">≠ Неравенства</h1>

    <p><strong>Неравенство</strong> — это математическое выражение, показывающее, что одно значение больше или меньше другого. В отличие от уравнений, неравенства могут иметь множество решений, образующих целые промежутки.</p>

    <div class="alert alert-success">
        Примеры неравенств:
        <ul>
            <li>\( 3x + 2 > 8 \)</li>
            <li>\( x^2 - 5x ≤ 6 \)</li>
            <li>\( \frac{1}{x} ≥ 2 \)</li>
        </ul>
    </div>

    <div class="method-card">
        <div class="method-title">📌 Виды неравенств</div>
        <p>Основные виды неравенств:</p>
        <ul>
            <li><strong>Линейные</strong>: \( ax + b > 0 \)</li>
            <li><strong>Квадратные</strong>: \( ax^2 + bx + c ≤ 0 \)</li>
            <li><strong>Дробно-рациональные</strong>: \( \frac{P(x)}{Q(x)} > 0 \)</li>
            <li><strong>Иррациональные</strong>: \( \sqrt{f(x)} ≥ g(x) \)</li>
        </ul>
    </div>

    <div class="method-card">
        <div class="method-title">🔢 Основные свойства неравенств</div>
        <ol>
            <li>Если \( a > b \), то \( b < a \)</li>
            <li>Если \( a > b \) и \( b > c \), то \( a > c \)</li>
            <li>Если \( a > b \), то \( a + c > b + c \)</li>
            <li>Если \( a > b \) и \( c > 0 \), то \( ac > bc \)</li>
            <li>Если \( a > b \) и \( c < 0 \), то \( ac < bc \) (знак меняется!)</li>
        </ol>
    </div>

    <div class="method-card">
        <div class="method-title">📊 Методы решения неравенств</div>
        <p><strong>1. Метод интервалов</strong> (для рациональных неравенств):</p>
        <ol>
            <li>Найти нули числителя и знаменателя</li>
            <li>Отметить их на числовой прямой</li>
            <li>Определить знак выражения в каждом интервале</li>
            <li>Выбрать подходящие интервалы в зависимости от знака неравенства</li>
        </ol>
        
        <p><strong>2. Графический метод</strong>:</p>
        <p>Построить графики левой и правой частей неравенства и определить, где выполняется соотношение.</p>
    </div>

    <div class="alert alert-warning">
        <strong>Важно!</strong> При умножении/делении неравенства на отрицательное число знак неравенства меняется на противоположный.
        <br>Пример: \( -2x > 6 \) ⇒ \( x < -3 \)
    </div>

    <p>🧠 Совет: Всегда проверяйте крайние точки и знаменатели в неравенствах — они могут быть точками разрыва!</p>

    <p class="text-center mt-4">
        <a href="../tasks/topic12.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
    </p>
</div>

<!-- Подключаем MathJax для отображения математических формул -->
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</body>
</html>