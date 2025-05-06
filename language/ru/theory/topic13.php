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
    <title>Переменная и функция - CyberMath</title>
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
        
        .concept-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .concept-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        code {
            background: #f8f9fa;
            padding: 2px 5px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body class="container py-5 position-relative">

    <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="emoji" style="left: <?= rand(0, 100) ?>%; top: <?= rand(10, 100) ?>px; animation-delay: <?= rand(0, 10) ?>s;">
            <?= ['📊','ƒ(x)','x','y','🔢','🧮','📐','🔍'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

<div class="card mx-auto" style="max-width: 900px;">
    <h1 class="mb-4 text-center">ƒ(x) Переменная и функция</h1>

    <div class="concept-card">
        <div class="concept-title">📌 Что такое переменная?</div>
        <p><strong>Переменная</strong> — это символ (обычно буква), который представляет неизвестное или изменяемое значение в математике. Переменные позволяют записывать общие правила и формулы.</p>
        
        <div class="alert alert-success">
            Примеры использования переменных:
            <ul>
                <li>Формула площади прямоугольника: <code>S = a × b</code></li>
                <li>Уравнение прямой: <code>y = kx + b</code></li>
            </ul>
        </div>
        
        <p>Переменные могут принимать разные значения в зависимости от условий задачи. Например, в уравнении <code>2x + 3 = 7</code> переменная <code>x</code> принимает значение 2.</p>
    </div>

    <div class="concept-card">
        <div class="concept-title">🧮 Что такое функция?</div>
        <p><strong>Функция</strong> — это зависимость одной переменной (обычно <code>y</code>) от другой переменной (обычно <code>x</code>), при которой каждому значению <code>x</code> соответствует единственное значение <code>y</code>.</p>
        
        <p>Функции обычно записывают в виде: <code>y = f(x)</code>, где <code>f</code> — правило, по которому <code>x</code> преобразуется в <code>y</code>.</p>
        
        <div class="alert alert-info">
            Примеры функций:
            <ul>
                <li>Линейная функция: <code>f(x) = 2x + 3</code></li>
                <li>Квадратичная функция: <code>f(x) = x² - 4</code></li>
                <li>Показательная функция: <code>f(x) = 3ˣ</code></li>
            </ul>
        </div>
    </div>

    <div class="concept-card">
        <div class="concept-title">📊 График функции</div>
        <p>Функцию можно представить графически на координатной плоскости. По горизонтальной оси (ось абсцисс) откладывают значения <code>x</code>, по вертикальной (ось ординат) — соответствующие значения <code>y = f(x)</code>.</p>
        
        <div class="alert alert-warning">
            Характеристики функций:
            <ul>
                <li><strong>Область определения</strong> — все возможные значения <code>x</code></li>
                <li><strong>Область значений</strong> — все возможные значения <code>y</code></li>
                <li><strong>Нули функции</strong> — значения <code>x</code>, при которых <code>f(x) = 0</code></li>
            </ul>
        </div>
    </div>

    <div class="concept-card">
        <div class="concept-title">🔢 Виды функций</div>
        <p>Основные виды функций в математике:</p>
        <ol>
            <li><strong>Линейные</strong>: <code>f(x) = kx + b</code> (график — прямая)</li>
            <li><strong>Квадратичные</strong>: <code>f(x) = ax² + bx + c</code> (график — парабола)</li>
            <li><strong>Степенные</strong>: <code>f(x) = xⁿ</code></li>
            <li><strong>Показательные</strong>: <code>f(x) = aˣ</code></li>
            <li><strong>Логарифмические</strong>: <code>f(x) = logₐx</code></li>
        </ol>
    </div>

    <p>🧠 Совет: Чтобы лучше понять функции, пробуйте строить их графики для разных значений параметров!</p>

    <p class="text-center mt-4">
        <a href="../tasks/topic13.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
    </p>
</div>
</body>
</html>