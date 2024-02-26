<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Авторизация</title>
</head>
<body>


<?php
session_start();
include('db.php');

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}

$login = $_SESSION["login"];
$currentPassword = $_POST["current_password"];
$newPassword = $_POST["new_password"];
$newEmail = $_POST["new_email"];

// Обработка загрузки нового аватара
$newAvatarPath = '';
if (isset($_FILES['new_avatar']) && $_FILES['new_avatar']['error'] == UPLOAD_ERR_OK) {
    $newAvatarName = $_FILES['new_avatar']['name'];
    $newAvatarTmpName = $_FILES['new_avatar']['tmp_name'];
    $newAvatarPath = "images/$newAvatarName";
    move_uploaded_file($newAvatarTmpName, $newAvatarPath);
}

$sql = "SELECT * FROM user_data WHERE login = '$login' AND password = '$currentPassword'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $updateSql = "UPDATE user_data SET password = '$newPassword', email = '$newEmail'";
    if ($newAvatarPath) {
        $updateSql .= ", avatar = '$newAvatarPath'";
    }
    $updateSql .= " WHERE login = '$login'";

    if ($conn->query($updateSql) === TRUE) {
        echo '<div class="container-fluid">';
        echo '<div class="col-md-4 offset-md-4">';
        echo '<div class="form-container">';
        echo '<div class="form-icon"><i class="fa fa-user"></i></div>';
        echo '<div class="alert alert-success" role="alert">Профиль успешно обновлен</div>';
        echo '<p><a  href="login.php" class="btn btn-secondary">Назад</a></p>';
        echo'</div>';
        echo'</div>';
        echo'</div>';
        echo'</div>';
    } else {
        // echo "Ошибка при обновлении профиля: " . $conn->error;
        echo '<div class="container-fluid">';
        echo '<div class="col-md-4 offset-md-4">';
        echo '<div class="form-container">';
        echo '<div class="form-icon"><i class="fa fa-user"></i></div>';
        echo '<div class="alert alert-danger error-message" role="alert">Ошибка при обновлении профиля</div>'. $conn->error;
        echo '<p><a  href="login.php" class="btn btn-secondary">Назад</a></p>';
        echo'</div>';
        echo'</div>';
        echo'</div>';
        echo'</div>';
          
    }
} else {
    echo '<div class="container-fluid">';
    echo '<div class="col-md-4 offset-md-4">';
    echo '<div class="form-container">';
    echo '<div class="form-icon"><i class="fa fa-user"></i></div>';
    echo '<div class="alert alert-danger error-message" role="alert">Текущий пароль неверен</div>';
    echo '<p><a  href="login.php" class="btn btn-secondary">Назад</a></p>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
   
}

$conn->close();
?>
</body>
</html>
