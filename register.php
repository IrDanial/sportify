<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name  = $_POST['full_name'];
    $gender     = $_POST['gender'];
    $birthdate  = $_POST['birthdate'];

    $sql = "INSERT INTO Users (username, password_hash, email, full_name, gender, birthdate) 
            VALUES ('$username', '$password', '$email', '$full_name', '$gender', '$birthdate')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Akun berhasil dibuat!'); window.location='login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal membuat akun!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>SPORTIFY</h1>
        </div>
        <div class="register-box">
            <form method="post">
                <label>Username</label>
                <input type="username" name="username" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Password</label>
                <input type="password" name="password" required>

                <label>Nama lengkap</label>
                <input type="full_name" name="full_name" required>

                <label>Gender</label>
                <select name="gender" required>
                    <option value="M">Laki-laki</option>
                    <option value="F">Perempuan</option>
                </select>

                <label>Tanggal Lahir</label>
                <input type="date" name="birthdate" required>

                <button type="submit" name="register">Buat Akun</button>

                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </form>
        </div>
    </div>
</body>

</html>