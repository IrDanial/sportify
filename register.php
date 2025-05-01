<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password
    $email    = $_POST['email'];
    $full_name = $_POST['full_name'];
    $gender   = $_POST['gender'];
    $birthdate = $_POST['birthdate'];

    $sql = "INSERT INTO Users (username, password_hash, email, full_name, gender, birthdate) 
            VALUES ('$username', '$password', '$email', '$full_name', '$gender', '$birthdate')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Akun berhasil dibuat'); window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

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
                <label for="username">Username</label>
                <input type="text" name="username" required><br>

                <label for="email">Email</label>
                <input type="email" name="email" required><br>

                <label for="password">Password</label>
                <input type="password" name="password" required><br>

                <label for="full_name">Nama lengkap</label>
                <input type="text" name="full_name" required><br>

                <label for="gender">Gender</label>
                <select name="gender" required>
                    <option value="M">Laki-laki</option>
                    <option value="F">Perempuan</option>
                </select><br>

                <label for="birthdate">Tanggal Lahir</label>
                <input type="date" name="birthdate" required><br>

                <button type="submit" name="register">Buat Akun</button>
            </form>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </div>
    </div>
</body>

</html>