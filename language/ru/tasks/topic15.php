<?php
session_start();
require_once '../../../db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$topic_id = 15;

$tasks = [
    [
        'question' => 'Чему равен sin(30°)?',
        'options' => ['1/2', '√2/2', '√3/2', '1'],
        'answer' => '1/2'
    ],
    [
        'question' => 'Какое из следующих тождеств верно?',
        'options' => ['sin²α + cos²α = 0', 'sin²α + cos²α = 1', 'sinα + cosα = 1', 'sinα - cosα = 0'],
        'answer' => 'sin²α + cos²α = 1'
    ],
    [
        'question' => 'Чему равен tan(45°)?',
        'options' => ['0', '1', '√2', '√3'],
        'answer' => '1'
    ],
    [
        'question' => 'В прямоугольном треугольнике гипотенуза равна 5, один катет равен 3. Чему равен sin противоположного угла?',
        'options' => ['3/5', '4/5', '3/4', '5/3'],
        'answer' => '3/5'
    ],
    [
        'question' => 'Какая функция определяется как отношение противолежащего катета к прилежащему?',
        'options' => ['Синус', 'Косинус', 'Тангенс', 'Котангенс'],
        'answer' => 'Тангенс'
    ]
];

$show_result = false;
$score = 0;
$user_answers = [];
$earned_bonus = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $show_result = true;

    foreach ($tasks as $i => $task) {
        $user_answer = $_POST['q' . $i] ?? null;
        $user_answers[$i] = $user_answer;

        if ($user_answer == $task['answer']) {
            $score++;
        }
    }

    if ($score === count($tasks)) {
        // Проверка, проходил ли пользователь эту тему ранее
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_topics WHERE user_id = ? AND topic_id = ?");
        $stmt->execute([$user_id, $topic_id]);
        $already_completed = $stmt->fetchColumn();

        if ($already_completed == 0) {
            // Засчитываем прохождение темы (триггер сам начислит 50 монет)
            $insert = $pdo->prepare("INSERT INTO user_topics (user_id, topic_id) VALUES (?, ?)");
            $insert->execute([$user_id, $topic_id]);

            $earned_bonus = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задачи: Основы тригонометрии</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f9f9f9, #eef3f7);
            font-family: 'Segoe UI', sans-serif;
        }

        .task-card {
            animation: fadeInUp 0.5s ease;
            transition: transform 0.3s;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 25px;
        }

        .task-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.15);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated-alert {
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .btn-success {
            transition: background-color 0.3s;
        }

        .btn-success:hover {
            background-color: #218838;
        }
        
        .task-question {
            font-size: 1.1rem;
            margin-bottom: 15px;
        }
        
        .triangle-img {
            max-width: 200px;
            margin: 10px auto;
            display: block;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="container py-5">
    <h1 class="mb-4 text-center">📐 Основы тригонометрии</h1>

    <?php if ($show_result): ?>
        <div class="alert alert-info animated-alert text-center fs-5">
            Вы правильно решили <?= $score ?> из <?= count($tasks) ?> задач!
            <?php if ($score === count($tasks) && $earned_bonus): ?>
                <br><strong class="text-success">+50 монет 💰</strong>
            <?php elseif ($score === count($tasks)): ?>
                <br><em class="text-muted">(уже пройдено ранее)</em>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <?php foreach ($tasks as $index => $task): ?>
            <div class="task-card">
                <div class="task-question"><?= ($index + 1) . ') ' . $task['question'] ?></div>
                
                <?php if ($index == 3): ?>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8f/Trigonometry_triangle.svg/400px-Trigonometry_triangle.svg.png" class="triangle-img" alt="Прямоугольный треугольник">
                <?php endif; ?>
                
                <?php foreach ($task['options'] as $opt): ?>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="q<?= $index ?>" value="<?= $opt ?>"
                            <?= isset($user_answers[$index]) && $user_answers[$index] == $opt ? 'checked' : '' ?> 
                            <?= $show_result ? 'disabled' : '' ?>>
                        <label class="form-check-label"><?= $opt ?></label>
                    </div>
                <?php endforeach; ?>

                <?php if ($show_result): ?>
                    <?php if (!isset($user_answers[$index])): ?>
                        <div class="mt-2 text-warning">❌ Нет ответа</div>
                    <?php elseif ($user_answers[$index] == $task['answer']): ?>
                        <div class="mt-2 text-success">✅ Правильно!</div>
                    <?php else: ?>
                        <div class="mt-2 text-danger">❌ Неправильно. Правильный ответ: <?= $task['answer'] ?></div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <div class="text-center mt-4">
            <?php if (!$show_result): ?>
                <button type="submit" class="btn btn-success btn-lg px-5">Показать результат</button>
            <?php elseif ($score < count($tasks)): ?>
                <a href="" class="btn btn-warning btn-lg px-5">Попробовать снова</a>
            <?php endif; ?>
        </div>
    </form>

    <div class="text-center mt-4">
        <a href="../theory/index.php" class="btn btn-outline-secondary">← Назад к темам</a>
    </div>
</body>
</html>