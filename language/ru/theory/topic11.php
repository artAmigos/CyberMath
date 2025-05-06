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
    <title>Квадратные уравнения - CyberMath</title>
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
            <?= ['🔢','✨','🧠','x²','Δ','=','➗','√'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

<div class="card mx-auto" style="max-width: 900px;">
    <h1 class="mb-4 text-center">📘 Квадратные уравнения и дискриминант</h1>

    <p><strong>Квадратное уравнение</strong> — это уравнение вида ax² + bx + c = 0, где a ≠ 0. Для его решения используется дискриминант (D), который определяет количество и тип корней.</p>

    <div class="alert alert-success">
        Пример: x² - 5x + 6 = 0 → D = 1, корни: <strong>2 и 3</strong>
    </div>

    <p><strong>Формула дискриминанта:</strong></p>
    <p class="text-center">D = b² - 4ac</p>

    <p><strong>Типы решений в зависимости от D:</strong></p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Дискриминант</th>
                <th>Количество корней</th>
                <th>Формула корней</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>D > 0</td>
                <td>2 различных</td>
                <td>x = (-b ± √D)/2a</td>
            </tr>
            <tr>
                <td>D = 0</td>
                <td>1 (кратный)</td>
                <td>x = -b/2a</td>
            </tr>
            <tr>
                <td>D < 0</td>
                <td>Нет действительных</td>
                <td>-</td>
            </tr>
        </tbody>
    </table>

    <p><strong>Алгоритм решения:</strong></p>
    <ol>
        <li>Привести уравнение к стандартному виду</li>
        <li>Вычислить дискриминант</li>
        <li>Определить количество корней</li>
        <li>Найти корни по формуле (если есть)</li>
    </ol>

    <div class="alert alert-warning">
        <strong>Пример полного решения:</strong><br>
        2x² - 4x - 6 = 0<br>
        1. D = (-4)² - 4·2·(-6) = 16 + 48 = 64<br>
        2. D > 0 → 2 корня<br>
        3. x = (4 ± √64)/4 = (4 ± 8)/4<br>
        4. x₁ = 3, x₂ = -1
    </div>

    <p>📌 Где применяются:</p>
    <ul>
        <li>В физике (расчет траекторий)</li>
        <li>В экономике (максимизация прибыли)</li>
        <li>В архитектуре (расчет конструкций)</li>
        <li>В компьютерной графике</li>
    </ul>

    <p>🧠 Совет: Всегда проверяйте знаки коэффициентов при вычислении дискриминанта!</p>

    <p class="text-center mt-4">
        <a href="../tasks/topic11.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
    </p>
</div>
</body>
</html>