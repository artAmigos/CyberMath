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
    <title>Системы линейных уравнений - CyberMath</title>
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
        
        .method-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .method-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="container py-5 position-relative">

    <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="emoji" style="left: <?= rand(0, 100) ?>%; top: <?= rand(10, 100) ?>px; animation-delay: <?= rand(0, 10) ?>s;">
            <?= ['📊','✖️','➕','➖','🔢','🧮','📐','🔍'][rand(0, 7)] ?>
        </div>
    <?php endfor; ?>

<div class="card mx-auto" style="max-width: 900px;">
    <h1 class="mb-4 text-center">📊 Системы линейных уравнений</h1>

    <p><strong>Система линейных уравнений</strong> — это набор из нескольких уравнений, в которых одни и те же переменные принимают одинаковые значения во всех уравнениях системы. Решение системы — это набор значений переменных, который удовлетворяет всем уравнениям одновременно.</p>

    <div class="alert alert-success">
        Пример системы с двумя переменными:
        \[
        \begin{cases}
        2x + 3y = 5 \\
        x - y = 1
        \end{cases}
        \]
    </div>

    <h3 class="mt-4">Основные методы решения:</h3>
    
    <div class="method-card">
        <div class="method-title">1. Метод подстановки</div>
        <p>Выражаем одну переменную через другую из одного уравнения и подставляем в другое уравнение.</p>
        <p>Пример:</p>
        \[
        \begin{cases}
        x + y = 5 \\
        2x - y = 1
        \end{cases}
        \]
        <p>Из первого уравнения: \( x = 5 - y \). Подставляем во второе: \( 2(5 - y) - y = 1 \) → \( 10 - 3y = 1 \) → \( y = 3 \), \( x = 2 \).</p>
    </div>
    
    <div class="method-card">
        <div class="method-title">2. Метод сложения</div>
        <p>Складываем или вычитаем уравнения системы так, чтобы одна из переменных исчезла.</p>
        <p>Пример:</p>
        \[
        \begin{cases}
        3x + 2y = 8 \\
        2x - 2y = 2
        \end{cases}
        \]
        <p>Складываем уравнения: \( 5x = 10 \) → \( x = 2 \). Подставляем в первое: \( 6 + 2y = 8 \) → \( y = 1 \).</p>
    </div>
    
    <div class="method-card">
        <div class="method-title">3. Графический метод</div>
        <p>Строим графики каждого уравнения и находим точку их пересечения.</p>
        <p>Пример:</p>
        \[
        \begin{cases}
        y = 2x - 1 \\
        y = -x + 5
        \end{cases}
        \]
        <p>Точка пересечения графиков (2, 3) — решение системы.</p>
    </div>

    <h3 class="mt-4">Особые случаи:</h3>
    <ul>
        <li><strong>Нет решений</strong> — уравнения противоречат друг другу (параллельные прямые).</li>
        <li><strong>Бесконечно много решений</strong> — уравнения эквивалентны (одинаковые прямые).</li>
    </ul>

    <div class="alert alert-warning">
        Пример системы без решений:
        \[
        \begin{cases}
        x + y = 2 \\
        x + y = 5
        \end{cases}
        \]
    </div>

    <p>🧠 Совет: Всегда проверяйте решение, подставляя найденные значения в исходные уравнения!</p>

    <p class="text-center mt-4">
        <a href="../tasks/topic10.php" class="btn btn-primary btn-lg fw-bold">Перейти к примерам 🚀</a>
    </p>
</div>

<!-- Подключаем MathJax для отображения математических формул -->
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</body>
</html>