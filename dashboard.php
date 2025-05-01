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

<!-- <body>
    <div class="container">
        <div class="left">
            <h1>SPORTIFY</h1>
            <button class="btn">Buat Jadwal Baru</button>
            <button class="btn">Riwayat</button>
        </div>

        <div class="right">
            <div class="jadwal-box">
                <h2>Jadwal Olahraga</h2>
                <php
                date_default_timezone_set('Asia/Jakarta');
                $now = date('H:i');

                $cekjadwal = mysqli_query($conn, "SELECT * FROM Workout_Plans WHERE user_id='$user_id'");

                if (mysqli_num_rows($cekjadwal) > 0) {
                    echo "<table>";
                    echo "<tr><th>Judul</th><th>Deskripsi</th><th>Waktu</th></tr>";
                    while ($jadwal = mysqli_fetch_assoc($cekjadwal)) {
                        $notif_time = '';
                        if (strpos($jadwal['description'], 'Notifikasi:') !== false) {
                            $notif_time = trim(str_replace('Notifikasi:', '', $jadwal['description']));
                        }

                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($jadwal['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($jadwal['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($jadwal['time']) . "</td>";
                        echo "</tr>";

                        if ($notif_time && $now >= $notif_time) {
                            echo "<script>alert('Waktunya latihan: " . htmlspecialchars($jadwal['title']) . "');</script>";
                        }
                    }
                    echo "</table>";
                } else {
                    echo "<p>Belum ada jadwal olahraga yang disimpan.</p>";
                }
                ?>
            </div>
        </div>

        <button class="logout-button">Logout</button>
    </div>
</body> -->

</html>