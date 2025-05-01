<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM Users WHERE email='$email'");
    $data = mysqli_fetch_assoc($cek);

    if ($data && password_verify($password, $data['password_hash'])) {
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['username'] = $data['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Email atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login SPORTIFY</title>
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
            padding: 50px 60px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 350px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            padding: 12px;
            border-radius: 10px;
            border: none;
            background-color: #cfd8dc;
            font-size: 16px;
        }

        button {
            padding: 12px;
            background-color: #cfd8dc;
            font-weight: bold;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #90caf9;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
                justify-content: center;
                padding: 30px;
            }

            .left {
                margin-bottom: 40px;
            }

            .right {
                width: 100%;
                max-width: 400px;
            }
        }
    </style>
</head>
<body>
    <div class="left">
        <h1>SPORTIFY</h1>
    </div>
    <div class="right">
        <form method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Masukkan email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Masukkan password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
