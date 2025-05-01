<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['preset'])) {
    $preset = $_POST['preset'];
    $exercises = $_POST['exercises'];
    $notifikasi = $_POST['notifikasi'];
    $user_id = $_SESSION['user_id'];

    $title = ucfirst(str_replace("_", " ", $preset));
    $description = "Notifikasi: " . $notifikasi;

    // Simpan ke Workout_Plans
    mysqli_query($conn, "INSERT INTO Workout_Plans (user_id, title, description) VALUES ('$user_id', '$title', '$description')");
    $plan_id = mysqli_insert_id($conn);

    foreach ($exercises as $exercise) {
        mysqli_query($conn, "INSERT INTO Exercises (plan_id, name, sets, reps) VALUES ('$plan_id', '$exercise', 0, 0)");
    }

    header("Location: dashboard.php");
    exit();
}
