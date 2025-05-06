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
    <title>Координатная плоскость - CyberMath</title>
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
            <?= ['📊','📍','📐','➕','➖','📘','🚀','🧮'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

<div class="card mx-auto" style="max-width: 900px;">
    <h1 class="mb-4 text-center">📘 Координатная плоскость</h1>

    <p><strong>Координатная плоскость</strong> — это двумерная плоскость, образованная двумя перпендикулярными осями: горизонтальной (ось X) и вертикальной (ось Y). Точка пересечения осей называется началом координат (0,0).</p>

    <div class="alert alert-success">
        Пример: Точка A(3, 2) находится на 3 единицы правее и на 2 единицы выше начала координат
    </div>

    <p><strong>Основные элементы:</strong></p>
    <ul>
        <li><strong>Ось абсцисс (X)</strong> — горизонтальная ось</li>
        <li><strong>Ось ординат (Y)</strong> — вертикальная ось</li>
        <li><strong>Координаты точки</strong> — пара чисел (x, y), определяющих положение точки</li>
        <li><strong>Четверти плоскости</strong> — 4 области, на которые оси делят плоскость</li>
    </ul>

    <p><strong>Четверти координатной плоскости:</strong></p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Четверть</th>
                <th>Знаки координат</th>
                <th>Пример</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>I</td>
                <td>(+, +)</td>
                <td>(2, 3)</td>
            </tr>
            <tr>
                <td>II</td>
                <td>(-, +)</td>
                <td>(-1, 4)</td>
            </tr>
            <tr>
                <td>III</td>
                <td>(-, -)</td>
                <td>(-3, -2)</td>
            </tr>
            <tr>
                <td>IV</td>
                <td>(+, -)</td>
                <td>(5, -1)</td>
            </tr>
        </tbody>
    </table>

    <p><strong>Как построить точку по координатам:</strong></p>
    <ol>
        <li>Найти значение x на оси X</li>
        <li>Найти значение y на оси Y</li>
        <li>Провести перпендикуляры из этих точек</li>
        <li>Точка пересечения перпендикуляров — искомая точка</li>
    </ol>

    <div class="alert alert-warning">
        <strong>Расстояние между точками:</strong><br>
        Для точек A(x₁, y₁) и B(x₂, y₂):<br>
        d = √[(x₂ - x₁)² + (y₂ - y₁)²]
    </div>

    <p>📌 Где применяется:</p>
    <ul>
        <li>В графиках функций</li>
        <li>В компьютерной графике</li>
        <li>В навигации и картографии</li>
        <li>В физике для описания движения</li>
    </ul>

    <p>🧠 Совет: Для запоминания порядка координат используйте фразу "Икс игрек, сначала по коридору, потом по лестнице".</p>

    <p class="text-center mt-4">
        <a href="../tasks/topic16.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
    </p>
</div>
</body>
</html>