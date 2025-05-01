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
    } else {
        echo "<script>alert('Email atau Password salah!');</script>";
    }
    if ($data) {
        if ($data['password'] === $password) {
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['username'] = $data['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="login-page">
    <div class="box">
        <h1>SPORTIFY</h1>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>

</html>