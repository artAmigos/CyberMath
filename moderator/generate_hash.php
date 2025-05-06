<?php
// Вводите пароль для хеширования
$password = 'lollol228'; // Замените на нужный пароль

// Генерация хеша пароля
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Вывод хеша
echo "Хешированное значение пароля: " . $hashed_password;
?>
