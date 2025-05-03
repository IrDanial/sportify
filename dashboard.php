<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
date_default_timezone_set('Asia/Jakarta');
$now = date('H:i');

// Ambil semua jadwal
$plans = mysqli_query($conn, "SELECT * FROM Workout_Plans WHERE user_id='$user_id' ORDER BY created_at DESC");

// Persiapkan notifikasi popup
$notif_array = [];
while ($plan = mysqli_fetch_assoc($plans)) {
    if (strpos($plan['description'], 'Notifikasi:') !== false) {
        $notif_time = trim(str_replace('Notifikasi:', '', $plan['description']));
        $notif_time_full = date('Y-m-d') . ' ' . $notif_time;

        $plan_id = $plan['plan_id'];
        $plan_title = htmlspecialchars($plan['title']);
        $popup_message = "<b>$plan_title</b><br>";

        $exercises_result = mysqli_query($conn, "SELECT * FROM Exercises WHERE plan_id='$plan_id'");
        while ($exercise = mysqli_fetch_assoc($exercises_result)) {
            $popup_message .= htmlspecialchars($exercise['name']) . "<br>";
        }

        $notif_array[] = [
            'waktu' => $notif_time_full,
            'pesan' => $popup_message
        ];
    }
}
mysqli_data_seek($plans, 0); // reset pointer hasil query
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <a href="logout.php"><button class="logout-button">Logout</button></a>

    <div class="container">
        <div class="left">
            <h1>SPORTIFY</h1>
            <a href="preset.php"><button>Buat Jadwal Baru</button></a>
            <a href="riwayat.php"><button>Riwayat</button></a>
        </div>

        <div class="right">
            <h2>Jadwal Olahraga</h2>

            <?php while ($plan = mysqli_fetch_assoc($plans)): ?>
                <?php
                $notif = '';
                if (strpos($plan['description'], 'Notifikasi:') !== false) {
                    $notif = trim(str_replace('Notifikasi:', '', $plan['description']));
                }

                $plan_id = $plan['plan_id'];
                $exercises = mysqli_query($conn, "SELECT * FROM Exercises WHERE plan_id='$plan_id'");
                $jam12 = $notif ? date("h:i A", strtotime($notif)) : '';
                ?>
                <div class="plan-box">
                    <div class="plan-header">
                        <?= htmlspecialchars($plan['title']) ?> <?= $notif ? "<small>$notif</small>" : '' ?>
                        <a href="hapus_jadwal.php?id=<?= $plan_id ?>" onclick="return confirm('Yakin hapus jadwal ini?')">
                            <button class="hapus-jadwal">🗑️</button>
                        </a>
                    </div>
                    <div class="plan-body">
                        <?php while ($ex = mysqli_fetch_assoc($exercises)): ?>
                            <div class="exercise-item">
                                <?= htmlspecialchars($ex['name']) ?>
                                <label class="check-icon">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php if ($popup_message): ?>
        <script>
            const notifications = <?= json_encode($notif_array) ?>;

            notifications.forEach(notif => {
                const targetTime = new Date(notif.waktu).getTime();
                const now = new Date().getTime();
                const delay = targetTime - now;

                if (delay > 0) {
                    setTimeout(() => {
                        Swal.fire({
                            title: 'Saatnya Berolahraga!',
                            html: notif.pesan,
                            icon: 'info',
                            confirmButtonText: 'Oke!'
                        });
                    }, delay);
                }
            });
        </script>

    <?php endif; ?>

</body>

</html>