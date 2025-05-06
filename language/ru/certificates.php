<?php
session_start();
require_once '../../db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT coins FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$coins = (int)$stmt->fetchColumn();

$titles = [
    50   => ["🚀 Новичок", "Ты сделал первый шаг. Начало положено! Уверенность возрастает, ты в пути."],
    200  => ["🔎 Исследователь", "Ты начал вникать в математику, задаёшь вопросы и получаешь ответы. Мышление становится точнее."],
    500  => ["📘 Мастер теории", "Ты овладел базовой теорией. Логика и структура стали твоими союзниками."],
    700  => ["🧠 Гуру знаний", "Твои знания впечатляют. Ты решаешь сложные задачи, учишь других. Начинаешь мыслить стратегически."],
    1000 => ["📚 Постоянный ученик", "Ты не останавливаешься. Математика — часть твоей жизни. Ты умеешь учиться и применять."],
    1200 => ["🧑‍🏫 Умный репетитор", "Ты делишься опытом. Твои советы помогают другим. Ты — наставник."],
    1500 => ["🎮 Топ Игрок", "Ты в топе. Концентрация, скорость, точность — твои лучшие качества."],
    2500 => ["🌟 Звезда CyberMath", "Ты сияешь в рейтинге. Твой прогресс вдохновляет других. Все знают твоё имя."],
    3000 => ["👑 Владыка Математики", "Ты контролируешь хаос чисел. Математика — твоя стихия. Авторитет."],
    4000 => ["💫 Бог Знаний", "Ты достиг вершины. Спокойствие, гений, понимание. У тебя нет границ."],
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>🎖️ Достижения - CyberMath</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@600&family=Rubik:wght@400;700&display=swap');

        body {
            background: linear-gradient(135deg, #f0f8ff, #ffffff);
            color: #2c2c54;
            font-family: 'Rubik', sans-serif;
            padding: 60px 20px;
            overflow-x: hidden;
        }

        h2 {
            text-align: center;
            margin-bottom: 50px;
            font-size: 3rem;
            color: #8e44ad;
            text-shadow: 0 0 10px rgba(142, 68, 173, 0.3);
        }

        .achievement {
            position: relative;
            padding: 30px;
            margin-bottom: 40px;
            border-radius: 20px;
            background: linear-gradient(135deg, #fff0fc, #e6faff);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border-left: 5px solid transparent;
            transition: transform 0.3s ease;
        }

        .achievement:hover {
            transform: scale(1.03);
        }

        .unlocked {
            border-left-color: #00b894;
        }

        .locked {
            opacity: 0.5;
        }

        .special-glow {
            animation: pulseShadow 3s infinite ease-in-out;
        }

        @keyframes pulseShadow {
            0%, 100% {
                box-shadow: 0 0 15px #a29bfe, 0 0 30px #81ecec;
            }
            50% {
                box-shadow: 0 0 30px #ffeaa7, 0 0 60px #fab1a0;
            }
        }

        .badge {
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
            font-size: 0.9rem;
        }

        .bg-success {
            background: linear-gradient(to right, #55efc4, #81ecec);
            color: #2d3436;
        }

        .bg-secondary {
            background: #dfe6e9;
            color: #636e72;
        }

        .level-indicator {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #ffeaa7;
            color: #2d3436;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: bold;
            box-shadow: 0 0 10px #fdcb6e;
        }

        .motivational-quote {
            text-align: center;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.1rem;
            margin-bottom: 40px;
            color: #6c5ce7;
            animation: floaty 8s infinite;
        }

        @keyframes floaty {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .btn-outline-primary {
            display: block;
            margin: 40px auto 0;
            font-size: 1.1rem;
            padding: 12px 28px;
            border-radius: 30px;
            border: 2px solid #6c5ce7;
            color: #6c5ce7;
            transition: 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: #6c5ce7;
            color: white;
            box-shadow: 0 0 15px rgba(108, 92, 231, 0.5);
        }

        .flying-emoji::before {
            content: "✨";
            font-size: 2rem;
            position: absolute;
            animation: floatEmoji 12s infinite linear;
            top: -100px;
            left: -50px;
        }

        @keyframes floatEmoji {
            0% {
                transform: translate(0, 0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translate(120vw, 120vh) rotate(720deg);
                opacity: 0;
            }
        }

        .achievement:nth-child(even)::before {
            content: "🧠";
        }

        .achievement:nth-child(odd)::before {
            content: "🌈";
        }

        .achievement::before {
            position: absolute;
            font-size: 2rem;
            opacity: 0.3;
            animation: floatEmoji 10s infinite ease-in-out;
            top: -40px;
            left: -30px;
        }

    </style>
</head>
<body>
    <div class="motivational-quote">«Ты либо решаешь уравнение, либо оно решает тебя.»</div>

    <div class="container">
        <h2>✨ Достижения CyberMath</h2>
        <?php foreach ($titles as $threshold => [$name, $description]): ?>
            <?php
                $isUnlocked = $coins >= $threshold;
                $isSpecial = $threshold >= 700;
                $classes = 'achievement';
                $classes .= $isUnlocked ? ' unlocked' : ' locked';
                if ($isUnlocked && $isSpecial) {
                    $classes .= ' special-glow';
                }
            ?>
            <div class="<?= $classes ?>">
                <div class="level-indicator">💰 <?= $threshold ?> монет</div>
                <h4><?= $name ?></h4>
                <p><?= $description ?></p>
                <span class="badge <?= $isUnlocked ? 'bg-success' : 'bg-secondary' ?>">
                    <?= $isUnlocked ? 'Получено' : 'Не получено' ?>
                </span>
            </div>
        <?php endforeach; ?>

        <a href="profile.php" class="btn btn-outline-primary">⬅ Назад в профиль</a>
    </div>
</body>
</html>
