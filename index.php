<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url("assets/images/background.jpg") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100vh;
            padding: 0 80px;
            box-sizing: border-box;
        }

        .left h1 {
            font-size: 60px;
            color: #fff59d;
            font-weight: bold;
            border-bottom: 4px solid #fff59d;
            display: inline-block;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
        }

        .right {
            background-color: #fff59d;
            padding: 60px;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            gap: 25px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .right a button {
            background-color: #cfd8dc;
            color: #000;
            font-weight: bold;
            border: none;
            padding: 15px 40px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .right a button:hover {
            background-color: #90caf9;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 30px;
            }

            .left h1 {
                font-size: 40px;
                text-align: center;
            }

            .right {
                padding: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="left">
        <h1>SPORTIFY</h1>
    </div>
    <div class="right">
        <a href="login.php"><button>Login</button></a>
        <a href="register.php"><button>Buat Akun</button></a>
    </div>
</body>
</html>
