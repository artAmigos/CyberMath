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
    <title>Теорема Пифагора - CyberMath</title>
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
        
        .triangle-img {
            max-width: 300px;
            margin: 20px auto;
            display: block;
        }
    </style>
</head>
<body class="container py-5 position-relative">

    <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="emoji" style="left: <?= rand(0, 100) ?>%; top: <?= rand(10, 100) ?>px; animation-delay: <?= rand(0, 10) ?>s;">
            <?= ['📐','△','🔺','📏','🧮','🔢','✨','🧠'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

    <div class="card mx-auto" style="max-width: 900px;">
        <h1 class="mb-4 text-center">📐 Теорема Пифагора</h1>

        <p><strong>Теорема Пифагора</strong> — одно из фундаментальных утверждений геометрии, которое связывает длины сторон прямоугольного треугольника. Эта теорема имеет огромное практическое значение в архитектуре, строительстве, навигации и многих других областях.</p>

        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/Pythagorean.svg/300px-Pythagorean.svg.png" alt="Прямоугольный треугольник" class="triangle-img">

        <div class="alert alert-success">
            <strong>Формулировка:</strong> В прямоугольном треугольнике квадрат гипотенузы равен сумме квадратов катетов.<br>
            c² = a² + b²
        </div>

        <p>Где:</p>
        <ul>
            <li><strong>a, b</strong> — катеты (стороны, образующие прямой угол)</li>
            <li><strong>c</strong> — гипотенуза (сторона, противоположная прямому углу)</li>
        </ul>

        <p>🔍 <strong>Пример применения:</strong> Если один катет равен 3 см, а другой — 4 см, то гипотенуза будет:</p>
        <div class="alert alert-warning">
            c² = 3² + 4² = 9 + 16 = 25<br>
            c = √25 = 5 см
        </div>

        <p>📌 <strong>Исторический факт:</strong> Хотя теорема названа в честь древнегреческого математика Пифагора, она была известна и использовалась задолго до него в Вавилоне, Египте и Индии.</p>

        <p>🧠 <strong>Практическое применение:</strong></p>
        <ul>
            <li>Расчёт расстояний между точками на плоскости</li>
            <li>Проверка прямых углов в строительстве</li>
            <li>Определение длины диагонали прямоугольника</li>
            <li>Навигация и расчёт маршрутов</li>
        </ul>

        <p>⚠️ <strong>Важно помнить:</strong> Теорема работает только для прямоугольных треугольников! Для других типов треугольников существуют другие соотношения между сторонами.</p>

        <p class="text-center mt-4">
            <a href="../tasks/topic17.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
        </p>
    </div>
</body>
</html>