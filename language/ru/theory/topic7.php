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
    <title>Степени и корни - CyberMath</title>
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
            <?= ['🔢','✨','🧠','√','^','²','³','∞'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

<div class="card mx-auto" style="max-width: 900px;">
    <h1 class="mb-4 text-center">📘 Степени и корни</h1>

    <p><strong>Степень числа</strong> — это краткая запись умножения числа на себя несколько раз. Записывается как aⁿ, где a — основание, n — показатель степени.</p>

    <div class="alert alert-success">
        Пример: 2³ = 2 × 2 × 2 = <strong>8</strong>
    </div>

    <p>Основные свойства степеней:</p>
    <ul>
        <li>aⁿ × aᵐ = aⁿ⁺ᵐ</li>
        <li>aⁿ ÷ aᵐ = aⁿ⁻ᵐ</li>
        <li>(aⁿ)ᵐ = aⁿᵐ</li>
        <li>a⁻ⁿ = 1/aⁿ</li>
        <li>a⁰ = 1 (для a ≠ 0)</li>
    </ul>

    <p><strong>Корень n-й степени</strong> из числа a — это число, n-я степень которого равна a. Обозначается как ⁿ√a.</p>

    <div class="alert alert-warning">
        Пример: ³√8 = <strong>2</strong>, так как 2³ = 8
    </div>

    <p>Свойства корней:</p>
    <ul>
        <li>ⁿ√(a × b) = ⁿ√a × ⁿ√b</li>
        <li>ⁿ√(a ÷ b) = ⁿ√a ÷ ⁿ√b</li>
        <li>(ⁿ√a)ᵐ = ⁿ√(aᵐ)</li>
        <li>ⁿ√ᵐ√a = ᵐⁿ√a</li>
    </ul>

    <p>🔍 Особые случаи:</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Тип</th>
                <th>Пример</th>
                <th>Объяснение</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Квадратный корень</td>
                <td>√9 = 3</td>
                <td>Корень 2-й степени (обычно пишут без цифры 2)</td>
            </tr>
            <tr>
                <td>Кубический корень</td>
                <td>³√27 = 3</td>
                <td>Корень 3-й степени</td>
            </tr>
            <tr>
                <td>Корень из степени</td>
                <td>√(4²) = 4</td>
                <td>При n = m корень и степень сокращаются</td>
            </tr>
        </tbody>
    </table>

    <p>📌 Примеры применения:</p>
    <ul>
        <li>Вычисление площадей (квадраты) и объемов (кубы)</li>
        <li>Решение уравнений и физических формул</li>
        <li>Финансовые расчеты с сложными процентами</li>
    </ul>

    <p>🧠 Совет: Для быстрого вычисления квадратов чисел до 20 и кубов до 10 лучше выучить таблицу степеней наизусть.</p>

    <p class="text-center mt-4">
        <a href="../tasks/topic7.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
    </p>
</div>
</body>
</html>