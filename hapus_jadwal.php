<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM Workout_Plans WHERE plan_id='$id'");
header("Location: dashboard.php");
