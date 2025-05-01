<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$plans = mysqli_query($conn, "SELECT plan_id FROM Workout_Plans WHERE user_id='$user_id' ORDER BY created_at DESC");
$all_exercises = [];

while ($plan = mysqli_fetch_assoc($plans)) {
    $plan_id = $plan['plan_id'];
    $result = mysqli_query($conn, "SELECT name FROM Exercises WHERE plan_id='$plan_id'");
    while ($row = mysqli_fetch_assoc($result)) {
        $all_exercises[] = $row['name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Olahraga - SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="riwayat-page">
    <div class="box-riwayat">
        <h2>Riwayat Olahraga</h2>
        <?php if (!empty($all_exercises)): ?>
            <?php foreach ($all_exercises as $exercise): ?>
                <div class="history-btn"><?= htmlspecialchars($exercise) ?></div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="empty-msg">Belum ada riwayat olahraga yang tercatat.</p>
        <?php endif; ?>
        <br><br>
        <a href="dashboard.php"><button class="selesai-btn">Selesai</button></a>
    </div>
</body>

</html>