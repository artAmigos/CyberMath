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
    <title>Площадь и периметр - CyberMath</title>
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
        
        .formula-box {
            background-color: #f8f9fa;
            border-left: 4px solid #6c5ce7;
            padding: 15px;
            margin: 15px 0;
            border-radius: 0 5px 5px 0;
        }
        
        .shape-img {
            max-width: 200px;
            margin: 15px auto;
            display: block;
        }
    </style>
</head>
<body class="container py-5 position-relative">

    <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="emoji" style="left: <?= rand(0, 100) ?>%; top: <?= rand(10, 100) ?>px; animation-delay: <?= rand(0, 10) ?>s;">
            <?= ['📏','📐','◻️','🔲','📊','🧮','✏️','🔶'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

    <div class="card mx-auto" style="max-width: 900px;">
        <h1 class="mb-4 text-center">📏 Площадь и периметр</h1>

        <p><strong>Площадь</strong> и <strong>периметр</strong> — это важные характеристики геометрических фигур, которые используются в строительстве, дизайне, архитектуре и многих других областях.</p>

        <div class="alert alert-info">
            <strong>Периметр</strong> — это сумма длин всех сторон фигуры.<br>
            <strong>Площадь</strong> — это мера поверхности, которую занимает фигура.
        </div>

        <h3 class="mt-4">🔷 Квадрат</h3>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Square_-_black_simple.svg/200px-Square_-_black_simple.svg.png" alt="Квадрат" class="shape-img">
        
        <div class="formula-box">
            <strong>Периметр:</strong> P = 4 × a<br>
            <strong>Площадь:</strong> S = a × a = a²<br>
            Где <em>a</em> — длина стороны квадрата
        </div>

        <h3 class="mt-4">🔶 Прямоугольник</h3>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4a/Rectangle_-_black_simple.svg/200px-Rectangle_-_black_simple.svg.png" alt="Прямоугольник" class="shape-img">
        
        <div class="formula-box">
            <strong>Периметр:</strong> P = 2 × (a + b)<br>
            <strong>Площадь:</strong> S = a × b<br>
            Где <em>a</em> и <em>b</em> — длины сторон прямоугольника
        </div>

        <h3 class="mt-4">🔺 Треугольник</h3>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Regular_triangle.svg/200px-Regular_triangle.svg.png" alt="Треугольник" class="shape-img">
        
        <div class="formula-box">
            <strong>Периметр:</strong> P = a + b + c<br>
            <strong>Площадь:</strong> S = (a × h) / 2<br>
            Где <em>a, b, c</em> — длины сторон, <em>h</em> — высота к стороне a
        </div>

        <div class="alert alert-warning mt-4">
            <strong>Практическое применение:</strong>
            <ul>
                <li>Расчёт количества краски для покраски стен (площадь)</li>
                <li>Определение длины забора вокруг участка (периметр)</li>
                <li>Расчёт количества плитки для пола (площадь)</li>
                <li>Определение длины бордюра для клумбы (периметр)</li>
            </ul>
        </div>

        <div class="alert alert-success">
            <strong>Пример:</strong> Квадратный участок имеет сторону 5 м.<br>
            Периметр: 4 × 5 = 20 м<br>
            Площадь: 5 × 5 = 25 м²
        </div>

        <p class="text-center mt-4">
            <a href="../tasks/topic19.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
        </p>
    </div>
</body>
</html>