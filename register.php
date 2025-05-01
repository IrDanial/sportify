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

<body class="register-page">
    <div class="box">
        <h1>SPORTIFY</h1>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="text" name="full_name" placeholder="Nama Lengkap" required><br>
            <select name="gender" required>
                <option value="">Jenis Kelamin</option>
                <option value="M">Laki-laki</option>
                <option value="F">Perempuan</option>
            </select><br>
            <input type="date" name="birthdate" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="register">Buat Akun</button>
        </form>
    </div>
</body>

</html>