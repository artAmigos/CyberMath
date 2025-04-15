<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Загружаем .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Получаем переменные
$host = $_ENV['DB_HOST'];
$db = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>
