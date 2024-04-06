<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Route Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('1.jpg'); /* Specify the path to your background image */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            position: relative; /* Add relative positioning */
            width: 66%;
            max-width: 600px;
            margin: 45px auto;
            background-color: rgba(255, 255, 255, 0.7); /* Add opacity to the background color */
            padding: 60px;
            border-radius: 15px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1; /* Grow to fill remaining space */
            transition: filter 0.3s; /* Add transition effect for the blur */
        }
        form {
            margin-bottom: 20px;
        }
        label, select, button {
            margin: 10px 0;
            width: 100%;
            box-sizing: border-box;
            display: block;
        }
        select, button {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .output-container {
            margin: 0 auto 50px;
            width: 90%;
            max-width: 600px;
            text-align: left;
            
        }
        .route-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
            color: deeppink;
            background-color: rgba(255, 255, 255, 0.8); 
            border-radius: 15px;
        }
        .output {
            background-color: #f9f9f9;
            border-radius: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            transition: background-color 0.3s;
        }
        .output:hover {
            background-color: #e0e0e0;
        }
        .bus-info {
            margin-bottom: 20px;
            padding: 10px;
        }
        .bold {
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        .icon img {
            width: 130px; /* Adjust the size as needed */
            height: auto;
            position: absolute;
            top: 10px; /* Adjust top position */
            left: 50%; /* Align to the middle */
            transform: translateX(-50%);
        }
        footer {
            margin-top: auto; /* Push footer to bottom */
            font-size: 14px;
            color: #666;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.8); /* Add opacity to the background color */
            border-top: 1px solid #ddd;
        }

        /* Loading Animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            z-index: 9999; /* Ensure loader is on top of everything */
            transition: opacity 0.3s; /* Add transition effect */
        }

        .loader {
            border: 6px dotted #007bff; /* Change border style to dotted and increase thickness */
            border-radius: 50%;
            width: 60px; /* Increase the size of the loading circle */
            height: 60px; /* Increase the size of the loading circle */
            animation: spin 2s linear infinite;
        }

        /* Add the font face for your Bengali font */
        /* Add the font face for Siyam Rupali */
        @font-face {
            font-family: 'Siyam Rupali';
            src: url('siyamrupali.ttf') format('truetype');
        }
        h1 {
            font-family: 'Siyam Rupali', Arial, sans-serif; /* Use Siyam Rupali font for Bangla text */
            font-size: 32px; /* Adjust font size as needed */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">
            <img src="11.png" alt="Icon">
        </div><br><br>
        <h1>ভাড়া নিবেন?</h1> <!-- This text will be displayed in YourBengaliFont -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="from"><b>---From---</b></label>
            <select name="from" id="from" required>
                <option value="">Select From</option>
                <option value="A">Place A</option>
                <option value="B">Place B</option>
                <option value="C">Place C</option>
                <!-- Add more options as needed -->
            </select>
            <label for="to"><b>---To---</b></label>
            <select name="to" id="to" required>
                <option value="">Select To</option>
                <option value="A">Place A</option>
                <option value="B">Place B</option>
                <option value="C">Place C</option>
                <!-- Add more options as needed -->
            </select>
            <button type="submit" onclick="showLoading()">Search</button>
        </form>
    </div>

    <!-- Loader Animation -->
    <div class="loader-container" id="loader-container">
        <div class="loader"></div>
    </div>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php
            $routes = [
                "A to B" => [["bus_name" => "Bus A", "fare" => 10], ["bus_name" => "Bus B", "fare" => 12]],
                "B to C" => [["bus_name" => "Bus X", "fare" => 14], ["bus_name" => "Bus Y", "fare" => 16]],
                // Add more routes as needed
            ];
            $from = $_POST['from'];
            $to = $_POST['to'];
            $route_key = $from . ' to ' . $to;

            if (array_key_exists($route_key, $routes)): ?>
                <div class="output-container">
                    <div class="route-title">Route: <?= htmlspecialchars($route_key) ?></div>
                    <?php foreach ($routes[$route_key] as $bus): ?>
                        <div class="output">
                            <div class="bus-info">
                                <p><span class="bold">Bus Name:</span> <?= htmlspecialchars($bus['bus_name']) ?></p>
                                <p><span class="bold">Fare:</span> $<?= htmlspecialchars($bus['fare']) ?></p>
                                <p><span class="bold">Student Fare:</span> $<?= max(10, $bus['fare'] * 0.5) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="output">
                    <p class="error">No bus route found from <?= htmlspecialchars($from) ?> to <?= htmlspecialchars($to) ?>.</p>
                </div>
            <?php endif; ?>
    <?php endif; ?>
    <footer>
        Developed by <strong>ISOLATE</strong> &copy; <?= date("Y") ?>. All rights reserved.
    </footer>

    <script>
        function showLoading() {
            document.getElementById("loader-container").style.display = "flex";
            document.querySelector(".container").style.filter = "blur(5px)"; // Apply blur effect to the background
        }
    </script>
</body>
</html>
