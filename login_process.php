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
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "user";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user_data WHERE login = '$login' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["login"] = $login;
        header("Location: welcome.php");
    } else {
        echo '<div class="container-fluid">';
        echo '<div class="col-md-4 offset-md-4">';
        echo '<div class="form-container">';
        echo '<div class="form-icon"><i class="fa fa-user"></i></div>';
        echo '<div class="alert alert-danger error-message" role="alert">Неверное имя пользователя или пароль</div>';
        echo '<p>Повторить вход? <a  href="login.php"> жми</a></p>';
        echo '<p>Забыли пароль?<a  href="edit_profile.php">Изменить</a></p>';
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