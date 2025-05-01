<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek user berdasarkan email
    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data && password_verify($password, $data['password_hash'])) {
        // Password cocok → buat session
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['username'] = $data['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        // Password/email salah
        echo "<script>alert('Email atau Password salah!');</script>";
    }
}
?>
