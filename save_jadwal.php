<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['preset'])) {
    $preset = $_POST['preset'];
    $user_id = $_SESSION['user_id'];
    $notifikasi = $_POST['notifikasi'];
    $title = ucfirst(str_replace("_", " ", $preset));
    $description = "Notifikasi: " . $notifikasi;

    if (empty($_POST['active'])) {
        echo "<script>alert('Pilih setidaknya satu latihan!'); window.history.back();</script>";
        exit();
    }

    mysqli_query($conn, "INSERT INTO Workout_Plans (user_id, title, description) VALUES ('$user_id', '$title', '$description')");
    $plan_id = mysqli_insert_id($conn);

    $exercises = $_POST['exercises'];
    $active_flags = $_POST['active'];

    foreach ($active_flags as $index) {
        $name = mysqli_real_escape_string($conn, $exercises[$index]);
        mysqli_query($conn, "INSERT INTO Exercises (plan_id, name, sets, reps, duration, notes) 
            VALUES ('$plan_id', '$name', 0, 0, 0, '')");
    }

    header("Location: dashboard.php");
    exit();
} else {
    echo "Invalid Request";
}
