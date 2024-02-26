<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">

    <title>Регистрация</title>
</head>
<body>
    
<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Обработка загрузки аватара
    $avatarPath = '';
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
        $avatarName = $_FILES['avatar']['name'];
        $avatarTmpName = $_FILES['avatar']['tmp_name'];
        $avatarPath = "images/$avatarName";
        move_uploaded_file($avatarTmpName, $avatarPath);
    }

    // Вставка данных в базу данных
    $sql = "INSERT INTO user_data (login, password, email, avatar) VALUES ('$login', '$password', '$email', '$avatarPath')";
    if ($conn->query($sql) === TRUE) {
        echo '<div class="container-fluid">';
        echo '<div class="col-md-4 offset-md-4">';
        echo '<div class="form-container">';
        echo '<div class="form-icon"><i class="fa fa-user"></i></div>';
        echo '<div class="alert alert-success" role="alert">Пользователь успешно зарегистрирован</div>';
        echo '<p><a  href="login.php" class="btn btn-secondary">Назад</a></p>';
        echo'</div>';
        echo'</div>';
        echo'</div>';
        echo'</div>';
        
    } else {
        // echo "Ошибка при регистрации: " . $conn->error;
        echo '<div class="container-fluid">';
        echo '<div class="col-md-4 offset-md-4">';
        echo '<div class="form-container">';
        echo '<div class="form-icon"><i class="fa fa-user"></i></div>';
        echo '<div class="alert alert-danger error-message" role="alert">Ошибка при регистрации:</div>'. $conn->error;
        echo '<p><a  href="login.php" class="btn btn-secondary">Назад</a></p>';
        echo'</div>';
        echo'</div>';
        echo'</div>';
        echo'</div>';
    }
}

$conn->close();
?>
</body>
</html>
