<?php
session_start();

if (!isset($_SESSION['moderator_id'])) {
    header('Location: /moderator/moderator_login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Модераторская панель</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <div class="max-w-xl mx-auto mt-12 bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">👮‍♂️ Добро пожаловать в Модерку</h1>

        <form method="POST" action="submit_request.php" class="space-y-5">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Ник пользователя</label>
                <input type="text" name="target_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Тип запроса</label>
                <select name="action" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="give_coins">Выдать монеты</option>
                    <option value="block_user">Заблокировать пользователя</option>
                    <option value="delete_user">Удалить пользователя</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Количество монет (если нужно)</label>
                <input type="number" name="coins" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Заметка</label>
                <textarea name="note" rows="3" placeholder="Причина запроса..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-200">
                    🚀 Отправить запрос
                </button>
            </div>
        </form>
    </div>
</body>
</html>
