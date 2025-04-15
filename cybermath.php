<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberMath</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #111;
            color: #fff;
        }
        .navbar {
            background: #222;
        }
        .btn-primary {
            background: #6a0dad;
            border: none;
        }
        .btn-primary:hover {
            background: #570c9b;
        }
        .hero {
            text-align: center;
            padding: 100px 20px;
            background: linear-gradient(135deg, #6a0dad, #000);
        }
        .service-card {
            background: #222;
            padding: 20px;
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .service-card:hover {
            transform: scale(1.05);
        }
        .contact-form {
            background: #222;
            padding: 30px;
            border-radius: 10px;
        }
        .leaderboard {
            background: #1b1b1b;
            border-radius: 10px;
            padding: 30px;
        }
        .leaderboard table {
            width: 100%;
            color: #fff;
        }
        .leaderboard th {
            color: #b77eff;
        }
        footer a:hover {
            color: #b77eff !important;
            transform: scale(1.2);
            transition: 0.3s;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">CyberMath</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#services">Как это работает</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">О проекте</a></li>
                    <li class="nav-item"><a class="nav-link" href="#leaderboard">Рейтинг</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Контакты</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <h1 class="display-4">Обменивайся знаниями и подписками</h1>
            <p class="lead">CyberMath — геймифицированная платформа для изучения математики и цифрового взаимодействия.</p>
            <a href="language/index.php" class="btn btn-primary btn-lg">Присоединиться</a>
        </div>
    </section>

    <section id="services" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Как это работает</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="service-card">
                        <h3>Решай задания</h3>
                        <p>Погружайся в увлекательные математические уровни от арифметики до продвинутых тем.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <h3>Зарабатывай очки</h3>
                        <p>Получай баллы за скорость, точность и активность. Поднимайся в рейтинге!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <h3>Обменивай и прокачивай</h3>
                        <p>Используй очки для обмена на подписки, скины и уникальные возможности в платформе.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-5">
        <div class="container text-center">
            <h2>О проекте</h2>
            <p>CyberMath — это больше чем просто биржа подписок. Это игровая обучающая среда, где каждый может развивать математические навыки, зарабатывать награды и обмениваться цифровыми ресурсами. 
            Мы объединяем обучение, геймификацию и реальную пользу в одном месте. Прокачивайся, решай, соревнуйся!</p>
        </div>
    </section>

    <section id="leaderboard" class="py-5">
        <div class="container leaderboard">
            <h2 class="text-center mb-4">Таблица лидеров</h2>
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Пользователь</th>
                        <th>Очки</th>
                        <th>Уровень</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Математик_007</td>
                        <td>4580</td>
                        <td>Гений</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Algebrator</td>
                        <td>4330</td>
                        <td>Профи</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Квадрат</td>
                        <td>4020</td>
                        <td>Знаток</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>RootMaster</td>
                        <td>3890</td>
                        <td>Исследователь</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Формула_Удачи</td>
                        <td>3715</td>
                        <td>Начинающий</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Связаться с нами</h2>
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
                        <button type="submit" class="btn btn-primary w-100">Отправить</button>
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
