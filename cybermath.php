<?php
$host = 'localhost';
$db   = 'cybermath'; 
$user = 'root';      
$pass = '';          
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo "Ошибка подключения к БД: " . $e->getMessage();
    exit;
}
?>

<?php
    $stmt = $pdo->query("
      SELECT u.name, u.coins, COUNT(ut.topic_id) AS solved_tasks
      FROM users u
      LEFT JOIN user_topics ut ON u.id = ut.user_id
      WHERE u.status = 'active'
      GROUP BY u.id
      ORDER BY u.coins DESC, solved_tasks DESC
      LIMIT 10
    ");
    $leaders = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CyberMath</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>

    html {
      scroll-behavior: smooth;
    }

    body {
      background-color: #111;
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      position: relative;
      overflow-x: hidden;
    }

    .hero {
        position: relative;
        min-height: 50vh;
        padding: 4rem 2rem;
        background: linear-gradient(to right, rgba(17, 17, 17, 0.95) 60%, rgba(17, 17, 17, 0.6));
        overflow: hidden;
    }

    .hero .container {
      max-width: 700px;
      z-index: 2;
    }

.hero-image {
  position: absolute;
  top: 0;
  right: 0;
  height: 100%;
  width: 45%;
  background: linear-gradient(to left, rgba(0, 0, 0, 0.7), transparent),
              url('assets/offer.png') no-repeat center center;
  background-size: cover;
  z-index: 1;
  pointer-events: none;
}


    .navbar {
      background: #222;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
    }

    .navbar-nav .nav-link {
      transition: color 0.3s, transform 0.3s;
    }

    .navbar-nav .nav-link:hover {
      color:hsl(267, 100.00%, 74.70%);
      transform: scale(1.05);
    }

    .btn-primary {
      background: #6a0dad;
      border: none;
      transition: background 0.3s, transform 0.2s;
    }

    .btn-primary:hover {
      background: #b77eff;
      transform: translateY(-2px);
    }

    .hero {
      text-align: center;
      padding: 120px 20px;
      background: linear-gradient(135deg, #6a0dad, #000);
      animation: fadeIn 1.5s ease;
      position: relative;
      z-index: 1;
      min-height: 50vh;
      overflow: hidden;
    }

    @keyframes fadeIn {
      from {
        
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .section-title {
      font-size: 2.5rem;
      margin-bottom: 30px;
      color: #b77eff;
    }

    .service-card {
      background: #222;
      padding: 25px;
      border-radius: 15px;
      transition: transform 0.3s, box-shadow 0.3s;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .service-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 20px #b77eff60;
    }

    .contact-form,
    .leaderboard {
      background: #1b1b1b;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
    }

    .leaderboard th {
      color: #b77eff;
    }

    .emoji-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      pointer-events: none;
      z-index: 0;
      overflow: hidden;
    }

    .emoji {
      position: absolute;
      font-size: 2.5rem;
      opacity: 0.6;
      animation: float 15s linear infinite;
    }


    @keyframes float {
      0% {
        transform: translateY(0) rotate(0deg);
        opacity: 0.6;
      }
      50% {
        opacity: 0.9;
      }
      100% {
        transform: translateY(-120vh) rotate(360deg);
        opacity: 0;
      }
    }

    .leaderboard {
        width: 100%;
        max-width: 800px;
        margin: 30px auto;
        border-collapse: collapse;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #1a1a1a;
        color: #e6e6e6;
        box-shadow: 0 0 15px #6a0dad;
        border-radius: 12px;
        overflow: hidden;
    }
    .leaderboard thead {
        background: #0f0f0f;
        color: #b77eff;
        font-weight: bold;
    }
    .leaderboard th, .leaderboard td {
        padding: 12px 20px;
        text-align: center;
    }
    .leaderboard tbody tr:nth-child(even) {
        background-color: #222;
    }
    .leaderboard tbody tr:hover {
        background-color: #333;
    }
    .leaderboard tbody tr td:first-child {
        font-weight: bold;
        color: #b77eff;
    }

    footer a {
      transition: transform 0.3s, color 0.3s;
    }

    footer a:hover {
      color: #b77eff !important;
      transform: scale(1.2);
    }

    .about-section {
      transition: transform 0.3s;
    }

    .about-section:hover {
      transform: scale(1.01);
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">CyberMath</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#services">Как это работает</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">О проекте</a></li>
          <li class="nav-item"><a class="nav-link" href="#leaderboard">Таблица лидеров</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Контакты</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="emoji-background" id="emojiBg">
    <span class="emoji">😊</span>
    <span class="emoji">🎓</span>
    <span class="emoji">📚</span>
    <span class="emoji">✏️</span>
    <span class="emoji">🧠</span>
  </div>

  <script>
  const emojiContainer = document.getElementById('emojiBg');

  const emojis = ['😊', '🎓', '📚', '✏️', '🧠', '💡', '🤓'];
  for (let i = 0; i < 10; i++) {
    const emoji = document.createElement('span');
    emoji.className = 'emoji';
    emoji.textContent = emojis[Math.floor(Math.random() * emojis.length)];
    emoji.style.left = Math.random() * 100 + 'vw';
    emoji.style.top = '100%';
    emoji.style.animationDelay = (Math.random() * 15) + 's';
    emojiContainer.appendChild(emoji);
  }

  setTimeout(() => {
    creators.forEach((creator, index) => {
      const img = document.createElement('img');
      img.src = creator.src;
      img.className = 'creator';
      img.style.left = creator.left;
      img.style.top = '100%';
      img.style.animationDelay = (index * 2) + 's';
      emojiContainer.appendChild(img);
      setTimeout(() => {
        img.style.opacity = '0.7';
      }, 50);
    });
  }, 20000);
</script>

<section class="hero d-flex align-items-center">
  <div class="container z-2 position-relative">
    <h1 class="display-4 fw-bold">Обменивайся знаниями, развивайся и занимай место в таблице лидеров!</h1>
    <p class="lead">CyberMath — геймифицированная платформа для изучения математики и цифровых навыков</p>
    <a href="language/index.php" class="btn btn-primary btn-lg mt-3">Присоединиться</a>
  </div>
  <div class="hero-image"></div>
</section>

  <section id="services" class="py-5">
    <div class="container">
      <h2 class="text-center section-title">Как это работает</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="service-card">
            <h3>Решай задания</h3>
            <p>Погружайся в увлекательные математические уровни от арифметики до продвинутых тем.Учись и открывай новое каждый день!</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-card">
            <h3>Зарабатывай очки</h3>
            <p>Получай баллы за скорость, точность и активность. Чем больше играешь — тем выше твой результат. Поднимайся в рейтинге!</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-card">
            <h3>Совершенствуйся</h3>
            <p>Используй очки для обмена на скины и уникальные возможности в платформе. Набери больше тысячи очков и стань репетитором!</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="about" class="py-5" style="background-color:#2f2f2f;">
    <div class="container text-center about-section">
      <h2 class="section-title">О проекте</h2>
      <p class="lead">CyberMath — это не просто игра. Это инновационная платформа для обучения, где каждый может освоить математику, улучшать свои навыки и зарабатывать баллы для получения уникальных призов.</p>
      <p>Мы создали гибкую и увлекательную систему, где задания разной сложности чередуются с игровыми элементами, чтобы процесс обучения был интерактивным и интересным. За каждое правильное решение вы получаете очки, которые можно обменять на различные награды: от скинов для профиля до эксклюзивных возможностей на платформе.</p>
      <p>Наша цель — сделать математику доступной и увлекательной для каждого. Мы хотим, чтобы обучение стало настоящим приключением!</p>
    </div>
  </section>

  <section id="leaderboard" class="py-5">
    <div class="container leaderboard">
    <h2 style="text-align:center; color:#b77eff; margin-top:40px;">🏆 Лидеры CyberMath</h2>
          <table class="leaderboard">
            <thead>
                <tr>
                  <th>#</th>
                  <th>Имя пользователя</th>
                  <th>Монетки</th>
                  <th>Решённые темы</th>
                </tr>
            </thead>
          <tbody>
          <?php
            $rank = 1;
            foreach ($leaders as $user) {
              echo "<tr>";
              echo "<td>{$rank}</td>";
              echo "<td>" . htmlspecialchars($user['name']) . "</td>";
              echo "<td>{$user['coins']}</td>";
              echo "<td>{$user['solved_tasks']}</td>";
              echo "</tr>";
              $rank++;
            }
          ?>
          </tbody>
        </table>
    </div>
  </section>

  <section id="contact" class="py-5">
    <div class="container">
      <h2 class="text-center section-title">Связаться с нами</h2>
      <div class="row justify-content-center">
        <div class="col-md-6 contact-form">
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Имя</label>
              <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Сообщение</label>
              <textarea class="form-control" id="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
          </form>
        </div>
      </div>
    </div>
  </section>

    <footer class="mt-5 pt-5 pb-4" style="background: linear-gradient(to right, #1a1a1a, #2a0a3d); color: #ccc;">
        <div class="container text-center">
            <div class="mb-4">
                <a href="#" class="mx-3 text-white fs-4" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="mx-3 text-white fs-4" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#" class="mx-3 text-white fs-4" target="_blank"><i class="fab fa-vk"></i></a>
            </div>
            <p class="mb-1" style="font-size: 1.1rem;">📧 info@cybermath.com</p>
            <p class="mb-2">📍 Estonia, Tallinn</p>
            <hr style="width: 60px; margin: 20px auto; border-top: 2px solid #6a0dad;">
            <p class="mb-0" style="font-size: 0.9rem;">© 2025 <strong>CyberMath</strong>. Все права защищены.</p>
        </div>
    </footer>
</body>
</html>