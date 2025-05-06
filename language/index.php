<?php
$host = $_SERVER['HTTP_HOST'];
$basePath = ($host === 'localhost') ? '/cybermath.com' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Choose Language</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Rubik', sans-serif;
      background: linear-gradient(135deg, #1c1c2b, #2d2d45, #4b3972);
      color: #fff;
      text-align: center;
      padding: 80px 20px;
      overflow-x: hidden;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .language-container {
      max-width: 600px;
      margin: 0 auto;
      background: rgba(255, 255, 255, 0.04);
      border-radius: 24px;
      padding: 50px 30px;
      box-shadow: 0 0 30px rgba(147, 112, 219, 0.3); /* фиолетовая тень */
      backdrop-filter: blur(10px);
      animation: fadeIn 1s ease;
      border: 1px solid rgba(147, 112, 219, 0.1);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    h1 {
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 40px;
      color: #e0d8ff;
      text-shadow: 0 0 12px rgba(147, 112, 219, 0.2);
    }

    .lang-btn {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      background: rgba(147, 112, 219, 0.1);
      border: 2px solid transparent;
      border-radius: 50%;
      width: 110px;
      height: 110px;
      margin: 15px;
      color: #eaeaff;
      font-weight: bold;
      transition: 0.3s;
    }

    .lang-btn img {
      width: 40px;
      height: 40px;
      margin-bottom: 10px;
      filter: drop-shadow(0 0 4px rgba(255, 255, 255, 0.1));
    }

    .lang-btn:hover {
      background: rgba(147, 112, 219, 0.2);
      transform: translateY(-5px);
      border-color: #9370db88;
      box-shadow: 0 0 20px rgba(147, 112, 219, 0.2);
    }

    .lang-row {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
    }

    @media (max-width: 576px) {
      h1 {
        font-size: 1.8rem;
      }

      .lang-btn {
        width: 90px;
        height: 90px;
      }

      .lang-btn img {
        width: 32px;
        height: 32px;
      }
    }
  </style>
</head>
<body>
  <div class="language-container">
    <h1>Choose your language</h1>
    <div class="lang-row">
      <a href="<?= $basePath ?>/language/ru/login.php" class="lang-btn">
        <img src="https://flagcdn.com/w40/ru.png" alt="Russian">
        RU
      </a>
      <a href="<?= $basePath ?>/language/et/login.php" class="lang-btn">
        <img src="https://flagcdn.com/w40/ee.png" alt="Estonian">
        ET
      </a>
    </div>
  </div>
</body>
</html>
