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
    <style>
        body {
            background: url("assets/images/background.jpg") no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .form-box {
            background-color: #fff59d;
            padding: 40px;
            border-radius: 20px;
            width: 350px;
            margin: 100px auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .form-box h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #d0e7f9;
            border: none;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 12px;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            background-color: #cfd8dc;
            cursor: pointer;
        }

        button:hover {
            background-color: #64b5f6;
        }

        .form-box p {
            text-align: center;
        }

        .form-box p a {
            color: #1565c0;
            text-decoration: none;
            font-weight: bold;
        }

        .form-box p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="form-box">
        <form method="post">
            <h1>SPORTIFY</h1>
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Nama lengkap</label>
            <input type="text" name="full_name" required>

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
</body>

</html>
