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
$popup_message = '';
while ($plan = mysqli_fetch_assoc($plans)) {
    if (strpos($plan['description'], 'Notifikasi:') !== false) {
        $notif_time = trim(str_replace('Notifikasi:', '', $plan['description']));
        if ($now >= $notif_time) {
            $plan_id = $plan['plan_id'];
            $plan_title = htmlspecialchars($plan['title']);
            $popup_message .= "<b>$plan_title</b><br>";

            // Ambil detail latihan
            $exercises_result = mysqli_query($conn, "SELECT * FROM Exercises WHERE plan_id='$plan_id'");
            while ($exercise = mysqli_fetch_assoc($exercises_result)) {
                $popup_message .= htmlspecialchars($exercise['name']) . "<br>";
            }
        }
    }
}
mysqli_data_seek($plans, 0); // Reset pointer hasil query agar bisa digunakan lagi
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background: url("assets/images/background.jpg") no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .logout-button {
            position: absolute;
            top: 20px;
            right: 30px;
            background-color: #cfd8dc;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            height: 100vh;
            padding: 60px 100px;
        }

        .left {
            color: #fff59d;
        }

        .left h1 {
            font-size: 50px;
            font-weight: bold;
            border-bottom: 4px solid #fff59d;
            display: inline-block;
            margin-bottom: 30px;
        }

        .left a button {
            display: block;
            margin: 10px 0;
        }

        .right {
            background-color: #fff176;
            padding: 30px;
            border-radius: 15px;
            width: 350px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .right h2 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .plan-box {
            margin-bottom: 20px;
            background-color: #fffde7;
            padding: 15px;
            border-radius: 10px;
        }

        .plan-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
        }

        .exercise-item {
            background-color: #f9fbe7;
            margin: 8px 0;
            padding: 8px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .check-icon {
            width: 18px;
            height: 18px;
            background-color: black;
            border-radius: 3px;
        }

        .delete-btn {
            background: none;
            border: none;
            color: red;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
        }

        /* Pop-up Notifikasi */
        .popup {
            position: fixed;
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
            background: #cfd8dc;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            z-index: 9999;
        }

        .popup h3 {
            margin-top: 0;
        }

        .popup button {
            margin-top: 10px;
            padding: 5px 20px;
        }
    </style>
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
            ?>
            <div class="plan-box">
                <div class="plan-header">
                    <?= htmlspecialchars($plan['title']) ?> <?= $notif ? "<small>$notif</small>" : '' ?>
                    <a href="hapus_jadwal.php?id=<?= $plan_id ?>" onclick="return confirm('Yakin hapus jadwal ini?')">
                        <button class="delete-btn">&times;</button>
                    </a>
                </div>
                <div class="plan-body">
                    <?php while ($ex = mysqli_fetch_assoc($exercises)): ?>
                        <div class="exercise-item">
                            <?= htmlspecialchars($ex['name']) ?>
                            <div class="check-icon"></div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php if ($popup_message): ?>
    <div class="popup" id="notifPopup">
        <h3>Saatnya Berolahraga!</h3>
        <?= $popup_message ?>
        <button onclick="document.getElementById('notifPopup').style.display='none'">Oke</button>
    </div>
<?php endif; ?>

</body>
</html>
