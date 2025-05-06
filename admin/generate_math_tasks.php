<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/admin_login.php');
    exit;
}

function createMathTasksFile($path, $content) {
    $file = fopen($path, 'w');
    fwrite($file, $content);
    fclose($file);
}

function generateRandomValue($min, $max) {
    return rand($min, $max);
}

function calculateAnswer($formula, $values) {
    extract($values);
    return eval("return $formula;");
}

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topicName = trim($_POST['topic_name']);
    $taskCount = (int)$_POST['task_count'];
    $questionTemplate = trim($_POST['question_template']);
    $answerFormula = trim($_POST['answer_formula']);
    $minValue = (int)$_POST['min_value'];
    $maxValue = (int)$_POST['max_value'];
    
    // Нахохждения следующего номера темы
    $existing = glob("../language/ru/math_tasks/topic*.php");
    $nextNumber = count($existing) + 1;
    
    // Создание пути к файлу
    $mathTasksPath = "../language/ru/math_tasks/topic{$nextNumber}.php";
    
    // Генерирация задачи
    $tasksArrayContent = "[\n";
    
    for ($i = 1; $i <= $taskCount; $i++) {
        $values = [
            'x' => generateRandomValue($minValue, $maxValue),
            'y' => generateRandomValue($minValue, $maxValue),
            'z' => generateRandomValue($minValue, $maxValue)
        ];
        
        $question = $questionTemplate;
        foreach ($values as $key => $value) {
            $question = str_replace("{" . $key . "}", $value, $question);
        }
        
        $answer = calculateAnswer($answerFormula, $values);
        
        $tasksArrayContent .= "    $i => [\n";
        $tasksArrayContent .= "        'question' => \"" . addslashes($question) . "\",\n";
        $tasksArrayContent .= "        'answer' => \"" . $answer . "\"\n";
        $tasksArrayContent .= "    ],\n";
    }
    
    $tasksArrayContent .= "];";
    
    $mathTasksContent = <<<PHP
<?php
session_start();
require_once '../../../db.php';

if (!isset(\$_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

const TASK_REWARD = 70;
\$user_id = \$_SESSION['user_id'];
\$topic_id = $nextNumber;

\$tasks = $tasksArrayContent

// Обработка формы
if (\$_SERVER['REQUEST_METHOD'] === 'POST') {
    \$task_id = (int)\$_POST['task_id'];
    \$given = trim(\$_POST['given']);
    \$solution = trim(\$_POST['solution']);
    \$user_answer = trim(\$_POST['answer']);

    if (empty(\$given) || empty(\$solution) || empty(\$user_answer)) {
        \$_SESSION['error_message'] = "Все поля должны быть заполнены!";
        header("Location: topic{\$topic_id}.php?task={\$task_id}");
        exit();
    }

    \$is_correct = (\$user_answer === \$tasks[\$task_id]['answer']);
    \$reward = 0;

    \$stmt = \$pdo->prepare("SELECT COUNT(*) FROM user_tasks WHERE user_id = ? AND topic_id = ? AND task_id = ? AND is_correct = 1");
    \$stmt->execute([\$user_id, \$topic_id, \$task_id]);
    \$already_solved = \$stmt->fetchColumn() > 0;

    if (\$is_correct) {
        if (!\$already_solved) {
            \$reward = TASK_REWARD;
            \$stmt = \$pdo->prepare("UPDATE users SET coins = coins + ? WHERE id = ?");
            \$stmt->execute([\$reward, \$user_id]);
            \$_SESSION['success_message'] = "Правильно! Вы заработали {\$reward} монет.";
        } else {
            \$_SESSION['success_message'] = "Правильно! Но вы уже решали эту задачу, монеты не начислены.";
        }
    } else {
        \$_SESSION['error_message'] = "❌ Неправильный ответ.";
    }

    \$stmt = \$pdo->prepare("INSERT INTO user_tasks (user_id, topic_id, task_id, given, solution, answer, is_correct, reward) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    \$stmt->execute([\$user_id, \$topic_id, \$task_id, \$given, \$solution, \$user_answer, \$is_correct, \$reward]);

    header("Location: topic{\$topic_id}.php?task={\$task_id}");
    exit();
}

\$current_task = isset(\$_GET['task']) ? (int)\$_GET['task'] : 1;
if (!isset(\$tasks[\$current_task])) {
    \$current_task = 1;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задачи: {$topicName} - CyberMath</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #f5f7fa, #c3cfe2); }
        .task-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 20px;
        }
        .form-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
        }
        .form-label { font-weight: 500; }
        .reward-badge {
            background-color: #00b894;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
        }
        .task-nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .task-number {
            font-size: 1.2rem;
            font-weight: 500;
        }
    </style>
</head>
<body class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">🧩 {$topicName}</h1>
        <a href="index.php" class="btn btn-outline-secondary">← Назад к темам</a>
    </div>

    <?php if (isset(\$_SESSION['error_message'])): ?>
        <div class="alert alert-danger mb-4">
            <?= \$_SESSION['error_message']; unset(\$_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset(\$_SESSION['success_message'])): ?>
        <div class="alert alert-success mb-4">
            <?= \$_SESSION['success_message']; unset(\$_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <div class="task-nav">
        <div><span class="task-number">Задача <?= \$current_task ?> из <?= count(\$tasks) ?></span></div>
        <div>
            <?php if (\$current_task > 1): ?>
                <a href="topic<?= \$topic_id ?>.php?task=<?= \$current_task - 1 ?>" class="btn btn-outline-primary btn-sm me-2">← Предыдущая</a>
            <?php endif; ?>
            <?php if (\$current_task < count(\$tasks)): ?>
                <a href="topic<?= \$topic_id ?>.php?task=<?= \$current_task + 1 ?>" class="btn btn-outline-primary btn-sm">Следующая →</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="task-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Задача <?= \$current_task ?></h3>
            <span class="reward-badge">+<?= TASK_REWARD ?> монет</span>
        </div>

        <div class="mb-4">
            <h5><?= htmlspecialchars(\$tasks[\$current_task]['question']) ?></h5>
        </div>

        <form method="post">
            <input type="hidden" name="task_id" value="<?= \$current_task ?>">
            <div class="form-section">
                <label for="given" class="form-label">Дано:</label>
                <textarea class="form-control" id="given" name="given" rows="3" required></textarea>
            </div>
            <div class="form-section">
                <label for="solution" class="form-label">Решение:</label>
                <textarea class="form-control" id="solution" name="solution" rows="5" required></textarea>
            </div>
            <div class="form-section">
                <label for="answer" class="form-label">Ответ:</label>
                <input type="text" class="form-control" id="answer" name="answer" required>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg px-5">Проверить</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input[required], textarea[required]');
        const submitBtn = form.querySelector('button[type="submit"]');
        
        function checkForm() {
            let allFilled = true;
            inputs.forEach(input => {
                if (!input.value.trim()) allFilled = false;
            });
            submitBtn.disabled = !allFilled;
        }

        inputs.forEach(input => input.addEventListener('input', checkForm));
        document.addEventListener('DOMContentLoaded', checkForm);
    </script>
</body>
</html>
PHP;

    // Создание файла
    createMathTasksFile($mathTasksPath, $mathTasksContent);
    
    $success = true;
    $createdNumber = $nextNumber;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Генерация математических задач - CyberMath</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <div class="card mx-auto" style="max-width: 800px;">
        <div class="card-body text-center">
            <?php if ($success): ?>
                <h2 class="text-success mb-4">✅ Задачи успешно созданы!</h2>
                <p class="mb-4">Тема "<?= htmlspecialchars($topicName) ?>" была сохранена как тема №<?= $createdNumber ?>.</p>
                
                <div class="d-flex justify-content-center gap-3 mb-4">
                    <a href="/cybermath.com/language/ru/math_tasks/topic<?= $createdNumber ?>.php" 
                       class="btn btn-primary" target="_blank">
                        Открыть задачи
                    </a>
                </div>
            <?php else: ?>
                <h2 class="text-danger mb-4">❌ Ошибка при создании задач</h2>
                <p>Не удалось создать задачи. Пожалуйста, попробуйте снова.</p>
            <?php endif; ?>
            
            <div class="mt-4">
                <a href="create_topic.php" class="btn btn-outline-primary me-2">Создать новые задачи</a>
                <a href="dashboard.php" class="btn btn-outline-secondary">Вернуться в админку</a>
            </div>
        </div>
    </div>
</body>
</html>