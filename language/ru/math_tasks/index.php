<?php
session_start();
require_once '../../../db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$topics = [
    1 => "Сложение и вычитание",
    2 => "Умножение и деление",
    3 => "Натуральные, целые, рациональные и иррациональные числа",
    4 => "Десятичные и обыкновенные дроби",
    5 => "Проценты",
    6 => "Арифметическая и геометрическая прогрессия",
    7 => "Степени и корни",
    8 => "Логарифмы",
    9 => "Линейные уравнения",
    10 => "Системы линейных уравнений",
    11 => "Квадратные уравнения и дискриминант",
    12 => "Неравенства",
    13 => "Переменная и функция",
    14 => "Графики функций",
    15 => "Основы тригонометрии",
    16 => "Координатная плоскость",
    17 => "Теорема Пифагора",
    18 => "Геометрические фигуры",
    19 => "Площадь и периметр",
    20 => "Введение в вероятность"
];

// Количество задач в каждой теме
$tasksCount = [
    1 => 8,   // Сложение и вычитание
    2 => 7,   // Умножение и деление
    3 => 6,   // Числа
    4 => 8,   // Дроби
    5 => 7,   // Проценты
    6 => 5,   // Прогрессии
    7 => 6,   // Степени и корни
    8 => 5,   // Логарифмы
    9 => 7,   // Линейные уравнения
    10 => 6,  // Системы уравнений
    11 => 6,  // Квадратные уравнения
    12 => 5,  // Неравенства
    13 => 6,  // Переменная и функция
    14 => 5,  // Графики
    15 => 6,  // Тригонометрия
    16 => 7,  // Координатная плоскость
    17 => 5,  // Теорема Пифагора
    18 => 8,  // Геометрические фигуры
    19 => 7,  // Площадь и периметр
    20 => 6   // Вероятность
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Решать задачи - CyberMath</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        }
        .topic-card {
            transition: all 0.3s;
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .topic-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .reward-badge {
            background-color: #00b894;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
        }
        .task-count {
            color: #6c5ce7;
            font-weight: 500;
        }
        .btn-solve {
            background-color: #6c5ce7;
            color: white;
            border: none;
        }
        .btn-solve:hover {
            background-color: #5649c0;
            color: white;
        }
    </style>
</head>
<body class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">🧩 Решать задачи</h1>
        <a href="../profile.php" class="btn btn-outline-secondary">← В профиль</a>
    </div>

    <div class="alert alert-info mb-4">
        <h5 class="alert-heading">Как это работает?</h5>
        <p class="mb-0">
            Выберите тему и задачу, решите её и получите <span class="reward-badge">+70 монет</span> за каждую правильно решённую задачу!
            В каждой задаче нужно заполнить все поля (Дано, Решение, Ответ) перед проверкой.
        </p>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($topics as $id => $topic): ?>
            <div class="col">
                <div class="card topic-card h-100">
                    <div class="card-body d-flex flex-column">
                        <h4 class="mb-3"><?= htmlspecialchars($topic) ?></h4>
                        <p class="task-count mb-3"><?= $tasksCount[$id] ?> задач</p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Тема <?= $id ?></span>
                                <a href="topic<?= $id ?>.php" class="btn btn-solve">Выбрать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>