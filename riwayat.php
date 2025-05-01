<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM Workout_Plans WHERE user_id='$user_id' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Olahraga - SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="riwayat-page">
    <div class="box">
        <h1>Riwayat Olahraga</h1>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="riwayat-item">
                <?= htmlspecialchars($row['title']) ?><br>
                <?= htmlspecialchars($row['created_at']) ?><br><br>
            </div>
        <?php endwhile; ?>
        <a href="dashboard.php"><button>Selesai</button></a>
    </div>
</body>

</html>