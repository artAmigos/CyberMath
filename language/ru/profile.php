<?php
session_start();
require_once '../../db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$coins = (int)$user['coins'];
$title = "Нет полученных достижений";

$titles = [
    4000 => "Бог Знаний",
    3000 => "Владыка Математики",
    2500 => "Звезда CyberMath",
    1500 => "Топ Игрок",
    1200 => "Умный репетитор",
    1000 => "Постоянный ученик",
    700  => "Гуру знаний",
    500  => "Мастер теории",
    200  => "Исследователь",
    50   => "Новичок"
];

foreach ($titles as $threshold => $rank) {
    if ($coins >= $threshold) {
        $title = $rank;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль - CyberMath</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { margin: 0; font-family: 'Rubik', sans-serif; background-color: #fff; color: #333; height: 100vh; overflow: hidden; display: flex; align-items: center; justify-content: center; padding: 20px; flex-direction: column; }
        .profile-box { background: #f9f9f9; border: 1px solid #ddd; padding: 60px 40px; border-radius: 20px; text-align: center; max-width: 400px; width: 100%; box-shadow: 0 0 30px rgba(0, 0, 0, 0.1); z-index: 2; margin-top: 130px; }
        .profile-box h1 { font-size: 2rem; font-weight: 700; margin-bottom: 15px; color: #333; }
        .profile-box p { font-size: 1rem; color: #555; }
        .btn-primary { background-color: #04a3ff; border: none; padding: 12px; border-radius: 10px; font-weight: bold; transition: all 0.3s ease; }
        .btn-primary:hover { background-color: #038ad1; }
        .smiley, .rocket { position: absolute; font-size: 30px; opacity: 0; animation: fly 10s infinite, fadeIn 1s forwards; }
        .smiley { animation-delay: calc(0.5s * var(--index)); }
        .rocket { font-size: 40px; animation-delay: calc(2s + 0.5s * var(--index)); color: #00bfff; }
        @keyframes fly { 0% { transform: translateY(0) translateX(0); } 100% { transform: translateY(-100vh) translateX(100vw); } }
        @keyframes fadeIn { 0% { opacity: 0; } 100% { opacity: 0.8; } }
        .smiley:nth-child(odd) { font-size: 35px; color: #ffcc00; }
        .smiley:nth-child(even) { font-size: 40px; color: #ff6699; }
        .navbar { font-size: 1.2rem; padding-top: 25px !important; padding-bottom: 25px !important; }
        .navbar a { padding: 15px 25px; font-size: 1.1rem; border-radius: 12px; }
        footer { z-index: 10; }
        @media (max-width: 480px) {
            .profile-box { padding: 50px 20px; }
            .profile-box h1 { font-size: 1.7rem; }
            .navbar { flex-direction: column; gap: 10px; }
            .navbar a { width: 100%; text-align: center; }
        }

        .rank-title {
    font-weight: bold;
    font-size: 1.2rem;
    color:rgb(0, 0, 0);
    text-transform: uppercase;
    letter-spacing: 1px;
    animation: glow 1.5s ease-in-out infinite alternate;
}

@keyframes glow {
    0% { text-shadow: 0 0 5px #04a3ff, 0 0 10px #04a3ff, 0 0 15px #04a3ff, 0 0 20px #04a3ff; }
    100% { text-shadow: 0 0 10px #ff1493, 0 0 20px #ff1493, 0 0 30px #ff1493, 0 0 40px #ff1493; }
}
    </style>
</head>
<body>
    <div class="smiley" style="left: 10%; top: 20%; --index: 1;">😊</div>
    <div class="smiley" style="left: 30%; top: 50%; --index: 2;">😎</div>
    <div class="smiley" style="left: 60%; top: 10%; --index: 3;">😄</div>
    <div class="smiley" style="left: 80%; top: 70%; --index: 4;">😁</div>
    <div class="rocket" style="left: 5%; top: 80%; --index: 5;">🚀</div>
    <div class="rocket" style="left: 70%; top: 40%; --index: 6;">🚀</div>
    <div class="rocket" style="left: 50%; top: 90%; --index: 7;">🚀</div>

    <nav class="navbar fixed-top bg-white shadow-sm px-4 d-flex justify-content-center gap-3">
        <a href="theory/index.php" class="btn btn-outline-primary fw-bold">📚 Теоретические материалы</a>
        <a href="theory/completed.php" class="btn btn-outline-success fw-bold">✅ Пройденные материалы</a>
        <a href="math_tasks/index.php" class="btn btn-primary fw-bold">🚀 Начать решать задачи</a>
        <a href="certificates.php" class="btn btn-outline-warning fw-bold">🏅 Мои достижения</a>
    </nav>

    <div class="profile-box">
        <h1>Привет, <?php echo $user['name']; ?>!</h1>
        <p>Email: <?php echo $user['email']; ?></p>
        <p>Дата регистрации: <?php echo $user['created_at']; ?></p>
        <p>Баланс: <?php echo $user['coins']; ?> монет</p>
        <p><strong>Звание:</strong> <span class="rank-title"><?php echo $title; ?></span></p>
    </div>

    <footer class="position-absolute bottom-0 start-0 end-0 text-center p-3 bg-light shadow-sm">
        <a href="logout.php" class="btn btn-danger fw-bold px-4 py-2">🚪 Выйти</a>
    </footer>
</body>
</html>
