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
            background: linear-gradient(to bottom right, #121212, #1e1e1e);
            color: #fff;
            text-align: center;
            padding: 50px 20px;
            overflow-x: hidden;
        }

        h1 {
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 40px;
            color: #e0e0e0;
        }

        .lang-card {
            background: #1b1b1b;
            border: 1px solid #2e2e2e;
            border-radius: 18px;
            padding: 25px;
            margin: 15px;
            text-decoration: none;
            color: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(6px);
        }

        .lang-card:hover {
            background: #292929;
            transform: translateY(-5px);
            box-shadow: 0 0 18px rgba(255, 255, 255, 0.05);
        }

        .lang-label-en {
            font-size: 1.25rem;
            font-weight: 700;
            color: #ffffff;
        }

        .lang-label-ru {
            font-size: 0.8rem;
            color: #bbbbbb;
            margin-top: 5px;
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 1.6rem;
            }

            .lang-label-en {
                font-size: 1.05rem;
            }

            .lang-label-ru {
                font-size: 0.75rem;
            }

            .lang-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Choose your language</h1>
        <div class="row justify-content-center">
            <?php
            $languages = [
                "id" => ["Indonesian", "Индонезийский"],
                "ja" => ["Japanese", "Японский"],
                "ko" => ["Korean", "Корейский"],
                "ru" => ["Russian", "Русский"],
                "hi" => ["Hindi", "Хинди"],
                "zh" => ["Chinese", "Китайский"],
                "pt" => ["Portuguese", "Португальский"],
                "es" => ["Spanish", "Испанский"],
                "en" => ["English", "Английский"]
            ];

            foreach ($languages as $code => [$enName, $ruName]) {
                echo "
                <div class='col-6 col-sm-4 col-md-3'>
                    <a class='lang-card d-block' href='$basePath/language/$code/login.php'>
                        <div class='lang-label-en'>$enName</div>
                        <div class='lang-label-ru'>$ruName</div>
                    </a>
                </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
