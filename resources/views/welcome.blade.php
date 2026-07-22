<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .welcome-message {
            font-size: 36px;
            font-weight: bold;
            color: #4a853f;
            text-align: center;
            padding: 20px;
            border: 2px solid #3db543;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: moveText 3s linear infinite alternate; /* Add animation */
        }
        @keyframes moveText {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(200px); /* Adjust the distance you want the text to move */
            }
        }
    </style>
</head>
<body>
    <div class="welcome-message">
        EVENTIFY
    </div>
</body>
</html>
