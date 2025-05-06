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
    <title>Основы тригонометрии - CyberMath</title>
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
        
        .trig-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .trig-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .trig-img {
            width: 100%;
            max-width: 300px;
            border-radius: 8px;
            margin: 10px auto;
            display: block;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="container py-5 position-relative">

    <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="emoji" style="left: <?= rand(0, 100) ?>%; top: <?= rand(10, 100) ?>px; animation-delay: <?= rand(0, 10) ?>s;">
            <?= ['📐','🔺','◢','◣','◥','◤','△','▽'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

<div class="card mx-auto" style="max-width: 900px;">
    <h1 class="mb-4 text-center">📐 Основы тригонометрии</h1>

    <p><strong>Тригонометрия</strong> — это раздел математики, изучающий соотношения между сторонами и углами треугольников, а также тригонометрические функции и их свойства.</p>

    <div class="alert alert-success">
        Основные понятия:
        <ul>
            <li><strong>Прямоугольный треугольник</strong> — треугольник с одним углом 90°</li>
            <li><strong>Гипотенуза</strong> — сторона, противолежащая прямому углу</li>
            <li><strong>Катеты</strong> — две другие стороны</li>
        </ul>
    </div>

    <div class="trig-card">
        <div class="trig-title">1. Основные тригонометрические функции</div>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8f/Trigonometry_triangle.svg/600px-Trigonometry_triangle.svg.png" alt="Прямоугольный треугольник" class="trig-img">
        <p>Для прямоугольного треугольника с углом α:</p>
        <ul>
            <li><strong>Синус</strong>: sin(α) = противолежащий катет / гипотенуза</li>
            <li><strong>Косинус</strong>: cos(α) = прилежащий катет / гипотенуза</li>
            <li><strong>Тангенс</strong>: tan(α) = противолежащий катет / прилежащий катет</li>
        </ul>
    </div>

    <div class="trig-card">
        <div class="trig-title">2. Основные тригонометрические тождества</div>
        <ul>
            <li>sin²(α) + cos²(α) = 1</li>
            <li>tan(α) = sin(α)/cos(α)</li>
            <li>1 + tan²(α) = 1/cos²(α)</li>
            <li>1 + cot²(α) = 1/sin²(α)</li>
        </ul>
    </div>

    <div class="trig-card">
        <div class="trig-title">3. Значения для стандартных углов</div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Угол</th>
                    <th>sin</th>
                    <th>cos</th>
                    <th>tan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>0°</td>
                    <td>0</td>
                    <td>1</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>30°</td>
                    <td>1/2</td>
                    <td>√3/2</td>
                    <td>√3/3</td>
                </tr>
                <tr>
                    <td>45°</td>
                    <td>√2/2</td>
                    <td>√2/2</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>60°</td>
                    <td>√3/2</td>
                    <td>1/2</td>
                    <td>√3</td>
                </tr>
                <tr>
                    <td>90°</td>
                    <td>1</td>
                    <td>0</td>
                    <td>∞</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="alert alert-warning">
        <strong>Важно!</strong> Тригонометрия применяется в:
        <ul>
            <li>Физике (колебания, волны)</li>
            <li>Инженерии (расчет конструкций)</li>
            <li>Компьютерной графике</li>
            <li>Навигации и астрономии</li>
        </ul>
    </div>

    <p class="text-center mt-4">
        <a href="../tasks/topic15.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
    </p>
</div>
</body>
</html>