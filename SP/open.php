<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blinking Icon Animation</title>
    <style>
        /* Define keyframes for blinking animation */
        @keyframes blink {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }

        /* Apply blinking animation to the icon */
        .blink-icon {
            animation: blink 2s infinite; /* Blinking animation for 2 seconds */
        }

        /* Center the icon */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Hide the icon initially */
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="#" id="blink-link">
            <img src="11.png" alt="Icon" class="blink-icon hidden">
        </a>
    </div>

    <script>
        // Show the blinking icon after 1 second
        setTimeout(function() {
            document.querySelector('.blink-icon').classList.remove('hidden');
        }, 1000);

        // Open the next website after 4 seconds
        setTimeout(function() {
            window.location.href = "https://example.com"; // Change this to the desired website URL
        }, 4000);
    </script>
</body>
</html>
