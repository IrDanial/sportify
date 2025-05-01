<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if (empty($exercises)) {
    echo "<script>alert('Pilih setidaknya satu latihan!'); window.history.back();</script>";
    exit();
}

if (isset($_POST['preset'])) {
    $preset = $_POST['preset'];
    $exercises = $_POST['exercises'];
    $sets = $_POST['sets'];
    $reps = $_POST['reps'];
    $durations = $_POST['durations'];
    $notes = $_POST['notes'];
    $notifikasi = $_POST['notifikasi'];
    $user_id = $_SESSION['user_id'];

    $title = ucfirst(str_replace("_", " ", $preset));
    $description = "Notifikasi: " . $notifikasi;

    // Simpan ke Workout_Plans
    mysqli_query($conn, "INSERT INTO Workout_Plans (user_id, title, description) VALUES ('$user_id', '$title', '$description')");
    $plan_id = mysqli_insert_id($conn);

    for ($i = 0; $i < count($exercises); $i++) {
        $name = mysqli_real_escape_string($conn, $exercises[$i]);
        $set = (int)$sets[$i];
        $rep = (int)$reps[$i];
        $duration = (int)$durations[$i];
        $note = mysqli_real_escape_string($conn, $notes[$i]);

        mysqli_query($conn, "INSERT INTO Exercises (plan_id, name, sets, reps, duration, notes) 
        VALUES ('$plan_id', '$name', '$set', '$rep', '$duration', '$note')");
    }

    header("Location: dashboard.php");
    exit();
}
