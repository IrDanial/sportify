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
    <style>
        body {
            margin: 0;
            background: url("assets/images/background.jpg") no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            padding: 50px;
            position: relative;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #333;
            background-color: #fff59d;
            display: inline-block;
            padding: 15px 40px;
            border-radius: 15px;
            font-size: 26px;
            margin: 0 auto 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .preset-container {
            display: flex;
            justify-content: center;
            gap: 40px;
        }

        .preset {
            background-color: #cfd8dc;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .preset img {
            width: 150px;
            height: 200px;
            border-radius: 10px;
            object-fit: cover;
        }

        .preset button {
            margin-top: 15px;
            background-color: #fff59d;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            border: none;
        }

        .preset button:hover {
            background-color: #fbc02d;
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
    </style>
</head>

<body>

    <a href="logout.php"><button class="logout-button">Logout</button></a>

    <h1>PRESET OLAHRAGA</h1>

    <div class="preset-container">
        <div class="preset">
            <img src="assets/images/bakar_lemak.jpg" alt="Bakar Lemak">
            <form method="get" action="preset_detail.php">
                <input type="hidden" name="type" value="bakar_lemak">
                <button type="submit">Bakar Lemak</button>
            </form>
        </div>
        <div class="preset">
            <img src="assets/images/latih_otot.jpg" alt="Latih Otot">
            <form method="get" action="preset_detail.php">
                <input type="hidden" name="type" value="latih_otot">
                <button type="submit">Latih Otot</button>
            </form>
        </div>
        <div class="preset">
            <img src="assets/images/tinggi_badan.jpg" alt="Tinggi Badan">
            <form method="get" action="preset_detail.php">
                <input type="hidden" name="type" value="tinggi_badan">
                <button type="submit">Tinggi Badan</button>
            </form>
        </div>
    </div>

</body>
</html>
