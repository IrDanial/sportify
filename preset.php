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

<body>

    <div class="modal">
        <a href="dashboard.php"><button class="close-button">✕</button></a>

        <h1>PRESET OLAHRAGA</h1>

        <div class="preset-container">
            <div class="preset">
                <img src="assets/image/lemak.png" alt="Bakar Lemak">
                <form method="get" action="preset_detail.php">
                    <input type="hidden" name="type" value="bakar_lemak">
                    <button type="submit">Bakar Lemak</button>
                </form>
            </div>

            <div class="preset">
                <img src="assets/image/otot.png" alt="Latih Otot">
                <form method="get" action="preset_detail.php">
                    <input type="hidden" name="type" value="latih_otot">
                    <button type="submit">Latih Otot</button>
                </form>
            </div>

            <div class="preset">
                <img src="assets/image/tinggi.png" alt="Tinggi Badan">
                <form method="get" action="preset_detail.php">
                    <input type="hidden" name="type" value="tinggi_badan">
                    <button type="submit">Tinggi Badan</button>
                </form>
            </div>
        </div>
    </div>

    <a href="logout.php"><button class="logout-button">Logout</button></a>

</body>

</html>