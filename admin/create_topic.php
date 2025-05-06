<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/admin_login.php');
    exit;
}

// Обработка удаления темы
if (isset($_GET['delete_topic'])) {
    $topicNum = (int)$_GET['delete_topic'];
    $theoryFile = "../language/ru/theory/topic{$topicNum}.php";
    $taskFile = "../language/ru/tasks/topic{$topicNum}.php";
    $mathTaskFile = "../language/ru/math_tasks/topic{$topicNum}.php";
    
    if (file_exists($theoryFile)) unlink($theoryFile);
    if (file_exists($taskFile)) unlink($taskFile);
    if (file_exists($mathTaskFile)) unlink($mathTaskFile);
    
    // Обновление список тем в index.php
    $topicsFile = "../language/ru/theory/index.php";
    $content = file_get_contents($topicsFile);
    
    if (preg_match('/\$topics\s*=\s*\[([^\]]+)\]/s', $content, $matches)) {
        $topicsArray = explode("\n", trim($matches[1]));
        $newTopics = [];
        
        foreach ($topicsArray as $line) {
            $line = trim($line);
            if (!empty($line) && !preg_match("/\"[^\"]*\"\s*,\s*$/", $line)) {
                $newTopics[] = $line;
            }
        }
        
        $newContent = str_replace(
            $matches[0], 
            '$topics = [' . "\n    " . implode("\n    ", $newTopics) . "\n];", 
            $content
        );
        
        file_put_contents($topicsFile, $newContent);
    }
    
    header("Location: create_topic.php?deleted={$topicNum}");
    exit;
}

// список существующих тем
$theoryFiles = glob("../language/ru/theory/topic*.php");
$topicsList = [];

foreach ($theoryFiles as $file) {
    $num = (int)preg_replace('/[^0-9]/', '', basename($file));
    $content = file_get_contents($file);
    if (preg_match('/<title>(.*?)<\/title>/', $content, $matches)) {
        $title = str_replace(' - CyberMath', '', $matches[1]);
        $topicsList[$num] = [
            'title' => $title,
            'theory_file' => $file
        ];
    }
}

ksort($topicsList);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание новой темы - CyberMath</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
        }
        .task-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .topics-list {
            max-height: 500px;
            overflow-y: auto;
        }
        .topic-item {
            transition: all 0.2s;
        }
        .topic-item:hover {
            background-color: #f8f9fa;
        }
        .delete-topic {
            opacity: 0;
            transition: opacity 0.2s;
        }
        .topic-item:hover .delete-topic {
            opacity: 1;
        }
        .admin-nav {
            margin-bottom: 20px;
        }
        .nav-tabs .nav-link.active {
            font-weight: bold;
            border-bottom: 3px solid #0d6efd;
        }
        .tab-content {
            padding: 20px 0;
        }
    </style>
</head>
<body class="container py-5">
    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Тема №<?= htmlspecialchars($_GET['deleted']) ?> успешно удалена!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="admin-nav">
        <a href="dashboard.php" class="btn btn-outline-secondary me-2">← В админку</a>
        <a href="/cybermath.com/language/ru/theory/index.php" class="btn btn-outline-primary" target="_blank">
            Просмотр списка тем
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-container">
                <h1 class="text-center mb-4">📝 Создание новой темы</h1>
                
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="theory-tab" data-bs-toggle="tab" data-bs-target="#theory" type="button" role="tab" aria-controls="theory" aria-selected="true">
                            Теория и примеры
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tasks-tab" data-bs-toggle="tab" data-bs-target="#tasks" type="button" role="tab" aria-controls="tasks" aria-selected="false">
                            Математические задачи
                        </button>
                    </li>
                </ul>
                
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="theory" role="tabpanel" aria-labelledby="theory-tab">
                        <form method="POST" action="generate_topic.php">
                            <div class="mb-4">
                                <label class="form-label">Название темы:</label>
                                <input type="text" name="topic_name" class="form-control" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Подробная теория:</label>
                                <textarea name="theory_text" class="form-control" rows="8" required></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Задания:</label>
                                <div id="tasks-container" class="mb-3">
                                    
                                </div>
                                <button type="button" onclick="addTask()" class="btn btn-outline-primary">
                                    + Добавить задание
                                </button>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-4 py-2">
                                    Сгенерировать тему 🚀
                                </button>
                                <a href="dashboard.php" class="btn btn-secondary px-4 py-2">Отмена</a>
                            </div>
                        </form>
                    </div>
                    
                    <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
                        <form method="POST" action="generate_math_tasks.php">
                            <div class="mb-4">
                                <label class="form-label">Название темы задач:</label>
                                <input type="text" name="topic_name" class="form-control" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Количество задач:</label>
                                <input type="number" name="task_count" class="form-control" min="1" max="20" value="5" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Шаблон вопроса:</label>
                                <textarea name="question_template" class="form-control" rows="3" required placeholder="Пример: На скамейке сидели {x} котенка. {y} котенка убежали, а ещё {z} кота сели на скамейку. Сколько теперь котиков сидит на скамейке?"></textarea>
                                <small class="text-muted">Используйте {x}, {y}, {z} для переменных значений</small>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Формула для ответа:</label>
                                <input type="text" name="answer_formula" class="form-control" required placeholder="Пример: x - y + z">
                                <small class="text-muted">Используйте те же переменные, что и в вопросе</small>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Диапазон значений для переменных:</label>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label">Минимум:</label>
                                        <input type="number" name="min_value" class="form-control" value="1" required>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Максимум:</label>
                                        <input type="number" name="max_value" class="form-control" value="10" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    Сгенерировать задачи 🚀
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">📚 Список существующих тем</h5>
                    <span class="badge bg-light text-dark"><?= count($topicsList) ?></span>
                </div>
                <div class="card-body topics-list p-0">
                    <?php if (!empty($topicsList)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($topicsList as $num => $topic): ?>
                                <div class="list-group-item topic-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="/cybermath.com<?= str_replace('..', '', $topic['theory_file']) ?>" 
                                           target="_blank" 
                                           class="text-decoration-none">
                                            <span class="fw-bold">Тема <?= $num ?>:</span>
                                            <span><?= htmlspecialchars($topic['title']) ?></span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="?delete_topic=<?= $num ?>" 
                                           class="delete-topic btn btn-sm btn-outline-danger"
                                           onclick="return confirm('Вы уверены, что хотите удалить тему <?= $num ?>?')">
                                            Удалить
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="p-3 text-center text-muted">
                            Нет созданных тем
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function addTask() {
            const container = document.getElementById('tasks-container');
            const index = container.children.length;
            
            const taskDiv = document.createElement('div');
            taskDiv.className = 'task-item';
            taskDiv.innerHTML = `
                <h5>Задание ${index + 1}</h5>
                <div class="mb-3">
                    <label class="form-label">Вопрос:</label>
                    <input type="text" name="tasks[${index}][question]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Варианты ответов (через запятую):</label>
                    <input type="text" name="tasks[${index}][options]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Правильный ответ:</label>
                    <input type="text" name="tasks[${index}][answer]" class="form-control" required>
                </div>
                <button type="button" onclick="this.parentNode.remove()" class="btn btn-outline-danger btn-sm">
                    Удалить задание
                </button>
            `;
            container.appendChild(taskDiv);
        }
        
        document.addEventListener('DOMContentLoaded', addTask);
    </script>
</body>
</html>