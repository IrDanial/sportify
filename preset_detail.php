<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$preset = $_GET['type'];

$workouts = [
    "bakar_lemak" => ["Berlari 30 Menit", "Berenang 1 Jam", "Bersepeda 1 Jam"],
    "latih_otot" => ["Bench Press 8x3 Set", "Pull-Down 8x3 Set", "Squat 8x3 Set"],
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
    <title>Edit Preset <?= ucfirst(str_replace("_", " ", $preset)) ?> - SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
    <!-- <style>
        body {
            background: url("assets/images/background.jpg") no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .box {
            background-color: #cfd8dc;
            width: 500px;
            margin: 60px auto;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
        }
        input[type="text"], input[type="time"] {
            width: 80%;
            padding: 10px;
            margin: 10px;
            border-radius: 6px;
            border: 1px solid #999;
            font-size: 14px;
        }
        .latihan-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 10px 0;
        }
        .latihan-item input[type="checkbox"] {
            transform: scale(1.3);
        }
        .submit-btn {
            background-color: #fff176;
            padding: 12px 30px;
            font-weight: bold;
            font-size: 16px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
    </style> -->
</head>

<body>
    <div class="container">
        <div class="box">
            <h2>Edit Preset <?= ucfirst(str_replace("_", " ", $preset)) ?></h2>
            <form method="post" action="save_jadwal.php" onsubmit="return validateForm()">
                <?php foreach ($workouts[$preset] as $index => $exercise): ?>
                    <div class="latihan-item">
                        <input type="text" name="exercises[]" value="<?= htmlspecialchars($exercise) ?>" required>
                        <input type="checkbox" name="active[]" value="<?= $index ?>">
                    </div>
                <?php endforeach; ?>

                <label>Notifikasi:</label>
                <input type="time" name="notifikasi" required><br>

                <input type="hidden" name="preset" value="<?= htmlspecialchars($preset) ?>">
                <button type="submit" class="submit-btn">Selesai</button>
            </form>
            <br><a href="preset.php"><button>Kembali</button></a>
        </div>

        <script>
            function validateForm() {
                const checkboxes = document.querySelectorAll('input[name="active[]"]:checked');
                if (checkboxes.length === 0) {
                    alert('Pilih setidaknya satu latihan!');
                    return false;
                }
                return true;
            }
        </script>
    </div>
</body>

</html>