<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Users WHERE user_id='$user_id'"));

if (isset($_POST['update'])) {
    $full_name = $_POST['full_name'];
    $birthdate = $_POST['birthdate'];

    $update_photo = '';
    if ($_FILES['photo']['name']) {
        $photo_name = 'profile_' . time() . '_' . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/images/' . $photo_name);
        $update_photo = ", profile_photo='$photo_name'";
    }

    mysqli_query($conn, "UPDATE Users SET full_name='$full_name', birthdate='$birthdate' $update_photo WHERE user_id='$user_id'");
    header("Location: profile.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profil SPORTIFY</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="profile-page">
    <div class="box">
        <h1>Profil Pengguna</h1>
        <?php if ($user['profile_photo']): ?>
            <img src="assets/images/<?= $user['profile_photo'] ?>" width="100" height="100" style="border-radius:50%;"><br><br>
        <?php else: ?>
            <p>Belum upload foto profil</p>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required><br>
            <input type="date" name="birthdate" value="<?= htmlspecialchars($user['birthdate']) ?>" required><br>
            Foto Profil: <input type="file" name="photo"><br><br>
            <button type="submit" name="update">Update Profil</button>
        </form>

        <br>
        <a href="dashboard.php"><button>Kembali</button></a>
    </div>
</body>

</html>