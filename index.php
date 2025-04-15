<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtA Systems</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-size: 28px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            flex-direction: column;
            overflow: hidden;
            position: relative;
        }
        
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            opacity: 0;
            animation: fadeIn 1.5s forwards;
        }

        .text {
            opacity: 0;
            animation: fadeInText 2s forwards;
            text-shadow: 0px 0px 15px cyan;
        }

        .text:nth-child(1) { animation-delay: 0s; }
        .text:nth-child(2) { animation-delay: 0.5s; }
        .text:nth-child(3) { animation-delay: 1s; }
        .text:nth-child(4) { animation-delay: 1.5s; }

        .hidden-ru {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.5);
            animation: fadeInText 2s forwards;
            margin-top: -10px;
            text-shadow: 0 0 5px rgba(0, 255, 255, 0.2);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeInText {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        .fade-out {
            animation: fadeOut 1s forwards;
        }

        /* Летающие смайлики */
        .emoji {
            position: absolute;
            font-size: 50px;
            animation: floatEmoji 5s infinite ease-in-out;
        }

        .emoji:nth-child(1) { top: 10%; left: 5%; animation-duration: 4s; }
        .emoji:nth-child(2) { top: 20%; left: 80%; animation-duration: 5s; }
        .emoji:nth-child(3) { top: 50%; left: 40%; animation-duration: 6s; }
        .emoji:nth-child(4) { top: 70%; left: 10%; animation-duration: 4.5s; }
        .emoji:nth-child(5) { top: 80%; left: 70%; animation-duration: 5.5s; }

        @keyframes floatEmoji {
            0% { transform: translateY(0px) rotate(0deg); opacity: 1; }
            50% { transform: translateY(-30px) rotate(180deg); opacity: 0.8; }
            100% { transform: translateY(0px) rotate(360deg); opacity: 1; }
        }
    </style>
</head>
<body>
    <!-- Летающие смайлики -->
    <div class="emoji">🚀</div>
    <div class="emoji">🔥</div>
    <div class="emoji">💡</div>
    <div class="emoji">🎯</div>
    <div class="emoji">⚡</div>

    <div id="loading-container" class="container">
        <p class="text">🚀 The best activity booste</p>
        <p class="text hidden-ru">🚀 Лучший усилитель активности</p>

        <p class="text">💡 CyberMath – Where you will become popular forever!</p>
        <p class="text hidden-ru">💡 CyberMath — Здесь ты прокачаешь знания и станешь известным навсегда</p>
    </div>
    
    <script>
        setTimeout(() => {
            document.getElementById("loading-container").classList.add("fade-out");
            setTimeout(() => {
                window.location.href = "cybermath.php"; // Редирект на сайт
            }, 1000);
        }, 4000); // Чуть дольше показываем (4 сек)
    </script>
</body>
</html>
