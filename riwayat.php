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
    <style>
        .box {
            background-color: #b0bec5;
            padding: 40px;
            border-radius: 15px;
            width: 50%;
            margin: 100px auto;
            text-align: center;
        }

        .history-btn {
            background-color: #fff59d;
            padding: 10px 20px;
            margin: 10px;
            display: inline-block;
            border-radius: 8px;
            font-weight: bold;
            border: none;
        }

        .empty-msg {
            font-style: italic;
            color: #444;
            margin: 20px;
        }

        .selesai-btn {
            margin-top: 30px;
            background-color: #fff176;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: bold;
            border: none;
        }
    </style>
</head>

<body class="riwayat-page">
    <div class="box">
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
