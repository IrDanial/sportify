<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM Progress_Tracker WHERE user_id='$user_id' ORDER BY date ASC");

$dates = [];
$weights = [];

while ($row = mysqli_fetch_assoc($result)) {
    $dates[] = $row['date'];
    $weights[] = $row['weight_kg'];
    $body_fats[] = $row['body_fat_percent'];
    $muscle_masses[] = $row['muscle_mass'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Grafik Progress - SPORTIFY</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="progress-page">
    <div class="box">
        <h1>Grafik Progress Berat Badan</h1>
        <canvas id="myChart" width="300" height="300"></canvas>
        <canvas id="bodyFatChart" width="300" height="300"></canvas>
        <canvas id="muscleChart" width="300" height="300"></canvas>
        <br><a href="dashboard.php"><button>Kembali</button></a>
        <a href="input_progress.php"><button>Input Baru</button></a>
    </div>

    <script>
        // Berat badan
        new Chart(document.getElementById('myChart'), {
            type: 'line',
            data: {
                labels: <?= json_encode($dates); ?>,
                datasets: [{
                    label: 'Berat Badan (kg)',
                    data: <?= json_encode($weights); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Lemak tubuh
        new Chart(document.getElementById('bodyFatChart'), {
            type: 'line',
            data: {
                labels: <?= json_encode($dates); ?>,
                datasets: [{
                    label: 'Persentase Lemak Tubuh (%)',
                    data: <?= json_encode($body_fats); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Massa otot
        new Chart(document.getElementById('muscleChart'), {
            type: 'line',
            data: {
                labels: <?= json_encode($dates); ?>,
                datasets: [{
                    label: 'Massa Otot (kg)',
                    data: <?= json_encode($muscle_masses); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>