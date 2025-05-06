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
    <title>Прогрессии - CyberMath</title>
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
            <?= ['🔢','✨','🧠','➗','✖️','📈','📉','∞'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

<div class="card mx-auto" style="max-width: 900px;">
    <h1 class="mb-4 text-center">📘 Арифметическая и геометрическая прогрессии</h1>

    <p><strong>Арифметическая прогрессия</strong> — это последовательность чисел, где каждое следующее число отличается от предыдущего на одну и ту же величину (разность прогрессии).</p>

    <div class="alert alert-success">
        Пример: 2, 5, 8, 11, 14... (разность d = 3)
    </div>

    <p>Основные формулы арифметической прогрессии:</p>
    <ul>
        <li><strong>n-й член:</strong> aₙ = a₁ + d(n-1)</li>
        <li><strong>Сумма n членов:</strong> Sₙ = (a₁ + aₙ)·n/2</li>
    </ul>

    <p><strong>Геометрическая прогрессия</strong> — это последовательность, где каждое следующее число получается умножением предыдущего на постоянное число (знаменатель прогрессии).</p>

    <div class="alert alert-warning">
        Пример: 3, 6, 12, 24, 48... (знаменатель q = 2)
    </div>

    <p>Основные формулы геометрической прогрессии:</p>
    <ul>
        <li><strong>n-й член:</strong> bₙ = b₁·qⁿ⁻¹</li>
        <li><strong>Сумма n членов:</strong> Sₙ = b₁(qⁿ - 1)/(q - 1)</li>
    </ul>

    <p>🔍 Основные различия:</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Характеристика</th>
                <th>Арифметическая</th>
                <th>Геометрическая</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Изменение</td>
                <td>Прибавление разности</td>
                <td>Умножение на знаменатель</td>
            </tr>
            <tr>
                <td>Пример</td>
                <td>5, 8, 11, 14...</td>
                <td>5, 10, 20, 40...</td>
            </tr>
            <tr>
                <td>График</td>
                <td>Линейный рост</td>
                <td>Экспоненциальный рост</td>
            </tr>
        </tbody>
    </table>

    <p>📌 Примеры применения:</p>
    <ul>
        <li>Арифметическая: начисление простых процентов, равномерное движение</li>
        <li>Геометрическая: сложные проценты в банках, рост популяции бактерий</li>
    </ul>

    <p>🧠 Совет: Для запоминания формул представьте реальные ситуации — например, рост вклада в банке (геометрическая) или ежедневное увеличение пробега на одинаковое расстояние (арифметическая).</p>

    <p class="text-center mt-4">
        <a href="../tasks/topic6.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
    </p>
</div>
</body>
</html>