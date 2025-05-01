<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $date = $_POST['date'];
    $weight = $_POST['weight'];
    $body_fat = $_POST['body_fat'];
    $muscle = $_POST['muscle'];
    $notes = $_POST['notes'];

    $query = "INSERT INTO Progress_Tracker (user_id, date, weight_kg, body_fat_percent, muscle_mass, notes) 
              VALUES ('$user_id', '$date', '$weight', '$body_fat', '$muscle', '$notes')";
    mysqli_query($conn, $query);
    header("Location: progress.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Progress - SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="progress-input-page">
    <div class="box">
        <h1>Input Progress Harian</h1>
        <form method="post">
            <input type="date" name="date" required><br>
            Berat Badan (kg): <input type="number" step="0.1" name="weight"><br>
            Lemak Tubuh (%): <input type="number" step="0.1" name="body_fat"><br>
            Massa Otot (kg): <input type="number" step="0.1" name="muscle"><br>
            Catatan: <input type="text" name="notes"><br><br>
            <button type="submit" name="submit">Simpan</button>
        </form>
        <a href="progress.php"><button>Kembali</button></a>
    </div>
</body>
</html>
