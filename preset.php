<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tujuan Olahraga - SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="preset-page">
    <div class="box">
        <h1>Pilih Tujuan Olahraga</h1>
        <form method="get" action="preset_detail.php">
            <select name="type" required>
                <option value="">-- Pilih --</option>
                <option value="bakar_lemak">Bakar Lemak</option>
                <option value="latih_otot">Bangun Otot</option>
                <option value="tinggi_badan">Meninggikan Badan</option>
            </select><br><br>
            <button type="submit">Lanjut</button>
        </form>
        <a href="dashboard.php"><button>Back</button></a>
    </div>
</body>

</html>