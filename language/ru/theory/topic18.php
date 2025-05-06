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
    <title>Геометрические фигуры - CyberMath</title>
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
        
        .shape-img {
            max-width: 200px;
            margin: 15px auto;
            display: block;
        }
        
        .shape-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 20px 0;
        }
        
        .shape-card {
            width: 30%;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body class="container py-5 position-relative">

    <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="emoji" style="left: <?= rand(0, 100) ?>%; top: <?= rand(10, 100) ?>px; animation-delay: <?= rand(0, 10) ?>s;">
            <?= ['🔺','🔵','◼️','📐','🔶','🔷','🟥','🟦'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

    <div class="card mx-auto" style="max-width: 900px;">
        <h1 class="mb-4 text-center">🔷 Геометрические фигуры</h1>

        <p><strong>Геометрические фигуры</strong> — это множество точек, линий или поверхностей, которые образуют замкнутые контуры. Они окружают нас повсюду: от простых предметов до сложных архитектурных сооружений.</p>

        <div class="alert alert-success">
            <strong>Основные виды фигур:</strong>
            <ul>
                <li>Плоские (двумерные) — существуют на плоскости</li>
                <li>Пространственные (трехмерные) — существуют в пространстве</li>
            </ul>
        </div>

        <h3 class="mt-4">🔹 Основные плоские фигуры</h3>
        
        <div class="shape-container">
            <div class="shape-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Circle-withsegments.svg/200px-Circle-withsegments.svg.png" alt="Круг" class="shape-img">
                <strong>Круг</strong>
                <p>Множество точек на плоскости, равноудаленных от центра</p>
            </div>
            <div class="shape-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Square_-_black_simple.svg/200px-Square_-_black_simple.svg.png" alt="Квадрат" class="shape-img">
                <strong>Квадрат</strong>
                <p>Четырехугольник с равными сторонами и углами</p>
            </div>
            <div class="shape-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Regular_triangle.svg/200px-Regular_triangle.svg.png" alt="Треугольник" class="shape-img">
                <strong>Треугольник</strong>
                <p>Фигура с тремя сторонами и тремя углами</p>
            </div>
        </div>

        <h3 class="mt-4">🔶 Основные объемные фигуры</h3>
        
        <div class="shape-container">
            <div class="shape-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Sphere_-_black_simple.svg/200px-Sphere_-_black_simple.svg.png" alt="Шар" class="shape-img">
                <strong>Шар</strong>
                <p>Тело, все точки которого равноудалены от центра</p>
            </div>
            <div class="shape-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Cube_-_black_simple.svg/200px-Cube_-_black_simple.svg.png" alt="Куб" class="shape-img">
                <strong>Куб</strong>
                <p>Правильный многогранник с 6 квадратными гранями</p>
            </div>
            <div class="shape-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/33/Cylinder_-_black_simple.svg/200px-Cylinder_-_black_simple.svg.png" alt="Цилиндр" class="shape-img">
                <strong>Цилиндр</strong>
                <p>Тело, ограниченное цилиндрической поверхностью</p>
            </div>
        </div>

        <div class="alert alert-warning mt-4">
            <strong>Интересный факт:</strong> В природе часто встречаются идеальные геометрические формы. Например, пчелиные соты образуют правильные шестиугольники, а пузыри стремятся к форме шара.
        </div>

        <p class="text-center mt-4">
            <a href="../tasks/topic18.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
        </p>
    </div>
</body>
</html>