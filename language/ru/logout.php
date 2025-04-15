<?php
session_start();  // Начало сессии

// Удаляем все данные сессии
session_unset();

// Уничтожаем саму сессию
session_destroy();

// Перенаправляем на страницу входа
header("Location: login.php");
exit;
?>
