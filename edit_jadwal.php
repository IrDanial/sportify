<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$plan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Workout_Plans WHERE plan_id='$id'"));

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    mysqli_query($conn, "UPDATE Workout_Plans SET title='$title', description='$description' WHERE plan_id='$id'");
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal - SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="edit-page">
    <div class="box">
        <h1>Edit Jadwal</h1>
        <form method="post">
            <input type="text" name="title" value="<?= htmlspecialchars($plan['title']) ?>" required><br>
            <input type="text" name="description" value="<?= htmlspecialchars($plan['description']) ?>" required><br>
            <button type="submit" name="update">Simpan</button>
        </form>
        <a href="dashboard.php"><button>Kembali</button></a>
    </div>
</body>

</html>