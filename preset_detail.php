<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$preset = $_GET['type'];

$workouts = [
    "bakar_lemak" => ["Berlari 30 Menit", "Berenang 1 Jam", "Bersepeda 1 Jam"],
    "latih_otot" => ["Bench Press 8x3 set", "Pull-Down 8x3 set", "Squat 8x3 set"],
    "tinggi_badan" => ["Pull-Up 12x3 Set", "Skipping 3x5 Menit", "Jump Squat 1x3 Set"]
];

if (!isset($workouts[$preset])) {
    echo "Preset tidak ditemukan!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Preset Detail - SPORTIFY</title>
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

        .box {
            background-color: #cfd8dc;
            padding: 40px;
            border-radius: 15px;
            width: 500px;
            max-width: 90%;
            margin: 100px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .box h1 {
            font-size: 22px;
            margin-bottom: 30px;
        }

        .exercise-field {
            margin-bottom: 15px;
        }

        input[type="text"] {
            width: 80%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #999;
        }

        .notif-group {
            margin-top: 30px;
            font-size: 16px;
        }

        .notif-group input {
            font-weight: bold;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .submit-button {
            margin-top: 30px;
            background-color: #fff59d;
            padding: 12px 30px;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            border: none;
        }

        .submit-button:hover {
            background-color: #fbc02d;
        }
    </style>
</head>

<body>
    <a href="logout.php"><button class="logout-button">Logout</button></a>

    <div class="box">
        <h1>Edit Preset <?= ucfirst(str_replace("_", " ", $preset)) ?></h1>

        <form method="post" action="save_jadwal.php">
            <?php foreach ($workouts[$preset] as $i => $exercise): ?>
                <div class="exercise-field">
                    <input type="text" name="exercises[]" value="<?= htmlspecialchars($exercise) ?>" required>
                </div>
            <?php endforeach; ?>

            <div class="notif-group">
                Notifikasi: <input type="time" name="notifikasi" required>
            </div>

            <input type="hidden" name="preset" value="<?= htmlspecialchars($preset) ?>">
            <br>
            <button type="submit" class="submit-button">Selesai</button>
        </form>
    </div>
</body>
</html>
