<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID jadwal tidak ditemukan!";
    exit();
}

$plan_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT * FROM Workout_Plans WHERE plan_id='$plan_id' AND user_id='$user_id'");
$plan = mysqli_fetch_assoc($result);

if (!$plan) {
    echo "Jadwal tidak ditemukan!";
    exit();
}

// Ambil waktu dari deskripsi jika ada
$notif_time = '';
if (strpos($plan['description'], 'Notifikasi:') !== false) {
    $notif_time = trim(str_replace('Notifikasi:', '', $plan['description']));
}

// Ambil latihan yang sudah ada
$exercises = mysqli_query($conn, "SELECT * FROM Exercises WHERE plan_id='$plan_id'");
$exercise_list = [];
while ($row = mysqli_fetch_assoc($exercises)) {
    $exercise_list[] = $row['name'];
}

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $waktu = mysqli_real_escape_string($conn, $_POST['waktu']);
    $new_exercises = $_POST['exercises'] ?? [];

    if (empty($new_exercises)) {
        $error = "Minimal satu latihan harus diisi!";
    } else {
        // Update judul dan waktu
        $desc = $waktu ? "Notifikasi: " . $waktu : "";
        mysqli_query($conn, "UPDATE Workout_Plans SET title='$title', description='$desc' WHERE plan_id='$plan_id'");

        // Hapus latihan lama
        mysqli_query($conn, "DELETE FROM Exercises WHERE plan_id='$plan_id'");

        // Simpan ulang latihan
        foreach ($new_exercises as $latihan) {
            $latihan = mysqli_real_escape_string($conn, $latihan);
            if (!empty($latihan)) {
                mysqli_query($conn, "INSERT INTO Exercises (plan_id, name) VALUES ('$plan_id', '$latihan')");
            }
        }

        header("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal Olahraga</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">
    <div class="box">
    <form method="POST">
        <h2>Edit Jadwal Olahraga</h2>

        
        <input type="text" name="title" value="<?= htmlspecialchars($plan['title']) ?>" required>

        
        <input type="time" name="waktu" value="<?= htmlspecialchars($notif_time) ?>">


        <div id="exercise-fields">
            <?php foreach ($exercise_list as $ex): ?>
                <input type="text" name="exercises[]" value="<?= htmlspecialchars($ex) ?>" class="exercise-input" required>
            <?php endforeach; ?>
            <input type="text" name="exercises[]" class="exercise-input" placeholder="Tambah latihan baru...">
        </div>
        <button type="button" onclick="addExerciseField()">Tambah latihan baru</button>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <br><br>
        <button type="submit">Simpan Perubahan</button>
    </form>
    <a href="dashboard.php"><button class="tombol-kembali">✕</button></a>
    </div>
</div>

<script>
function addExerciseField() {
    const container = document.getElementById('exercise-fields');
    const input = document.createElement('input');
    input.type = "text";
    input.name = "exercises[]";
    input.className = "exercise-input";
    input.placeholder = "Tambah latihan baru...";
    container.appendChild(input);
}
</script>

</body>
</html>
