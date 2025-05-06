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
    <title>Графики функций - CyberMath</title>
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
        
        .graph-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .graph-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .graph-img {
            width: 100%;
            border-radius: 8px;
            margin: 10px 0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="container py-5 position-relative">

    <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="emoji" style="left: <?= rand(0, 100) ?>%; top: <?= rand(10, 100) ?>px; animation-delay: <?= rand(0, 10) ?>s;">
            <?= ['📈','📉','📊','🧮','🔢','📐','🔍','ƒ(x)'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

<div class="card mx-auto" style="max-width: 900px;">
    <h1 class="mb-4 text-center">📈 Графики функций</h1>

    <p><strong>График функции</strong> — это визуальное представление зависимости между переменными. Он позволяет наглядно увидеть поведение функции, ее свойства и особенности.</p>

    <div class="alert alert-success">
        Основные элементы графика:
        <ul>
            <li><strong>Ось абсцисс (OX)</strong> — горизонтальная ось, обычно для независимой переменной</li>
            <li><strong>Ось ординат (OY)</strong> — вертикальная ось, обычно для зависимой переменной</li>
            <li><strong>Точки графика</strong> — пары (x, f(x))</li>
        </ul>
    </div>

    <div class="graph-card">
        <div class="graph-title">1. Линейная функция: y = kx + b</div>
        <img src="https://www.mathsisfun.com/algebra/images/linear-graph.svg" alt="График линейной функции" class="graph-img">
        <p>График — прямая линия. <code>k</code> — угловой коэффициент (наклон), <code>b</code> — точка пересечения с осью OY.</p>
        <div class="alert alert-info">
            Пример: y = 2x + 1<br>
            Наклон: 2 (график поднимается на 2 единицы вверх при движении на 1 единицу вправо)<br>
            Пересечение с OY: (0, 1)
        </div>
    </div>

    <div class="graph-card">
        <div class="graph-title">2. Квадратичная функция: y = ax² + bx + c</div>
        <img src="https://www.mathsisfun.com/algebra/images/quadratic-graph.svg" alt="График квадратичной функции" class="graph-img">
        <p>График — парабола. Если <code>a > 0</code> — ветви вверх, если <code>a < 0</code> — ветви вниз.</p>
        <p>Вершина параболы имеет координаты: <code>x = -b/(2a)</code></p>
    </div>

    <div class="graph-card">
        <div class="graph-title">3. Обратная пропорциональность: y = k/x</div>
        <img src="https://www.mathsisfun.com/algebra/images/reciprocal-graph.svg" alt="График обратной пропорциональности" class="graph-img">
        <p>График — гипербола. Функция не определена при <code>x = 0</code>.</p>
    </div>

    <div class="graph-card">
        <div class="graph-title">4. Показательная функция: y = aˣ</div>
        <img src="https://www.mathsisfun.com/algebra/images/exponential-graph.svg" alt="График показательной функции" class="graph-img">
        <p>При <code>a > 1</code> функция возрастает, при <code>0 < a < 1</code> — убывает.</p>
        <p>Всегда проходит через точку (0,1), так как a⁰ = 1.</p>
    </div>

    <h3 class="mt-4">Как строить графики?</h3>
    <ol>
        <li>Составить таблицу значений (x и y)</li>
        <li>Отметить точки на координатной плоскости</li>
        <li>Соединить точки плавной линией</li>
        <li>Проверить особые точки (пересечения с осями, вершины)</li>
    </ol>

    <div class="alert alert-warning">
        <strong>Важно!</strong> Обращайте внимание на:
        <ul>
            <li>Область определения функции</li>
            <li>Поведение функции на бесконечности</li>
            <li>Точки разрыва и асимптоты</li>
        </ul>
    </div>

    <p class="text-center mt-4">
        <a href="../tasks/topic14.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
    </p>
</div>
</body>
</html>