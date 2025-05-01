<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Kalau belum login, redirect ke login.php
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="dashboard-page">
    <div class="box">
        <h1>SPORTIFY</h1>
        <?php
        date_default_timezone_set('Asia/Jakarta');
        $now = date('H:i');

        $cekjadwal = mysqli_query($conn, "SELECT * FROM Workout_Plans WHERE user_id='$user_id'");
        while ($jadwal = mysqli_fetch_assoc($cekjadwal)) {
            if (strpos($jadwal['description'], 'Notifikasi:') !== false) {
                $notif_time = trim(str_replace('Notifikasi:', '', $jadwal['description']));
                if ($now >= $notif_time) {
                    echo "<script>alert('Waktunya latihan: " . htmlspecialchars($jadwal['title']) . "');</script>";
                    break;
                }
            }
        }
        ?>
        <a href="profile.php"><button>Profil</button></a>
        <a href="preset.php"><button>Buat Jadwal Baru</button></a>
        <a href="riwayat.php"><button>Riwayat</button></a><br><br>
        <a href="logout.php"><button>Logout</button></a>
    </div>
</body>

</html>