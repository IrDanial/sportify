<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$preset = $_GET['type'];

$workouts = [
    "bakar_lemak" => ["Berlari 30 Menit", "Berenang 1 Jam", "Bersepeda 1 Jam"],
    "latih_otot" => ["Bench Press 8x8 Set", "Pull-Down 8x8 Set", "Squat 8x8 Set"],
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
</head>

<body class="preset-detail-page">
    <div class="box">
        <h1>Edit Preset<br><?= ucfirst(str_replace("_", " ", $preset)) ?></h1>
        <form method="post" action="save_jadwal.php">
            <?php foreach ($workouts[$preset] as $exercise): ?>
                <input type="checkbox" name="exercises[]" value="<?= htmlspecialchars($exercise) ?>"> <?= htmlspecialchars($exercise) ?><br>
            <?php endforeach; ?>
            <br>
            Notifikasi: <input type="time" name="notifikasi" required><br><br>
            <input type="hidden" name="preset" value="<?= htmlspecialchars($preset) ?>">
            <button type="submit">Selesai</button>
        </form>
        <a href="preset.php"><button>Back</button></a>
    </div>
</body>

</html>