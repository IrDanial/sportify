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
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>SPORTIFY</h1>
        </div>
        <div class="login-box">
            <form method="post">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required><br>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required><br>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>

</html>