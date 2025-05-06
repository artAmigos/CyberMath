<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/admin_login.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM moderator_requests ORDER BY created_at DESC");
$requests = $stmt->fetchAll();

if (isset($_POST['ban_user'])) {
    $target_name = $_POST['target_name'];
    $stmt = $pdo->prepare("UPDATE users SET status = 'blocked' WHERE name = ?");
    $stmt->execute([$target_name]);
}

if (isset($_POST['unban_user'])) {
    $target_name = $_POST['target_name'];
    $stmt = $pdo->prepare("UPDATE users SET status = 'active' WHERE name = ?");
    $stmt->execute([$target_name]);
}

if (isset($_POST['update_coins'])) {
    $target_name = $_POST['target_name'];
    $new_coins = $_POST['coins'];
    $stmt = $pdo->prepare("UPDATE users SET coins = ? WHERE name = ?");
    $stmt->execute([$new_coins, $target_name]);
}

if (isset($_POST['delete_user'])) {
    $target_name = $_POST['target_name'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE name = ?");
    $stmt->execute([$target_name]);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans p-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">👑 Добро пожаловать в Админку</h1>

        <?php if (count($requests) > 0): ?>
            <div class="overflow-x-auto">
                <table class="w-full table-auto bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Ник</th>
                            <th class="px-4 py-3">Действие</th>
                            <th class="px-4 py-3">Монеты</th>
                            <th class="px-4 py-3">Заметка</th>
                            <th class="px-4 py-3">Дата</th>
                            <th class="px-4 py-3">Управление</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php foreach ($requests as $req): ?>
                            <tr class="border-b hover:bg-gray-100 transition duration-200">
                                <td class="px-4 py-3"><?= $req['id'] ?></td>
                                <td class="px-4 py-3 font-semibold"><?= htmlspecialchars($req['target_name']) ?></td>
                                <td class="px-4 py-3"><?= $req['action'] ?></td>
                                <td class="px-4 py-3"><?= $req['coins'] ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($req['note']) ?></td>
                                <td class="px-4 py-3"><?= $req['created_at'] ?></td>
                                <td class="px-4 py-3">
                                    <form method="POST" action="handle_request.php" class="flex gap-2">
                                        <input type="hidden" name="request_id" value="<?= $req['id'] ?>">
                                        <input type="hidden" name="target_name" value="<?= htmlspecialchars($req['target_name']) ?>">
                                        <input type="hidden" name="action" value="<?= $req['action'] ?>">
                                        <input type="hidden" name="coins" value="<?= $req['coins'] ?>">
                                        <button type="submit" name="do_action" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Выполнить</button>
                                        <button type="submit" name="delete_only" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <form method="POST" action="clear_requests.php" class="text-center mt-8">
                <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-red-600 transition duration-200">
                    🧹 Очистить все запросы
                </button>
            </form>
        <?php else: ?>
            <div class="text-center text-gray-600 mt-12 text-xl">
                💤 Нет запросов от модераторов
            </div>
        <?php endif; ?>

        <h2 class="text-2xl font-semibold text-gray-800 mt-10">Управление пользователями</h2>
        <div class="space-y-6 mt-4">

            <form method="POST" class="flex items-center gap-4">
                <input type="text" name="target_name" placeholder="Ник пользователя" class="px-4 py-2 border rounded w-1/4" required>
                <button type="submit" name="ban_user" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Забанить</button>
                <button type="submit" name="unban_user" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Снять бан</button>
            </form>

            <form method="POST" class="flex items-center gap-4">
                <input type="text" name="target_name" placeholder="Ник пользователя" class="px-4 py-2 border rounded w-1/4" required>
                <input type="number" name="coins" placeholder="Количество монет" class="px-4 py-2 border rounded w-1/4" required>
                <button type="submit" name="update_coins" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Обновить монеты</button>
            </form>

            <form method="POST" class="flex items-center gap-4">
                <input type="text" name="target_name" placeholder="Ник пользователя" class="px-4 py-2 border rounded w-1/4" required>
                <button type="submit" name="delete_user" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Удалить пользователя</button>
            </form>
        </div>
    </div>

    <div class="mt-12 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">🛠️ Генератор новых тем</h2>
            <p class="text-gray-600 mb-4">Здесь вы можете создать новую тему и её задания для пользователей.</p>
        <a href="create_topic.php" class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
        ➕ Новая тема
        </a>
    </div>

</body>
</html>
