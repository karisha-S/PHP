<?php
session_start();
include('db.php');

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}

$login = $_SESSION["login"];
$sql = "SELECT * FROM user_data WHERE login = '$login'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentPassword = $row["password"];
    $currentEmail = isset($row["email"]) ? $row["email"] : '';
    $currentAvatar = $row["avatar"];
    $login = isset($row["login"]) ? $row["login"] : '';
} else {
    echo "Ошибка при загрузке профиля: " . $conn->error;
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование профиля</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <div class="container-fluid">
    <div class="col-md-4 offset-md-4">
        <div class="form-container">
            <div class="form-icon"><i class="fa fa-user"></i></div>
            <form class="form-horizontal" method="post" action="edit_profile_process.php" enctype="multipart/form-data">
                <h2 class="title">Редактирование профиля</h2>
                <div class="form-group">
                    <label for="current_password">Текущий пароль:</label>
                    <input type="password" name="current_password" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <label for="new_password">Новый пароль:</label>
                    <input type="password" name="new_password" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <label for="new_email">Новый Email:</label>
                    <input type="email" name="new_email" value="<?php echo $currentEmail; ?>" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <label for="new_login">Новый логин:</label>
                    <input type="text" name="new_login" value="<?php echo $login; ?>" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <label for="new_avatar">Выберите новый аватар (изображение):</label>
                    <input type="file" name="new_avatar" class="form-control"><br>
                </div>
                <?php if ($currentAvatar): ?>
                    <p>Текущий аватар:</p>
                    <img src="<?php echo $currentAvatar; ?>" alt="Avatar" width="100">
                <?php endif; ?>
               <p> <button type="submit" name="edit" class="btn btn-default">Сохранить изменения</button></p>
                <p><a  href="login.php" class="btn btn-secondary">Отмена</a></p>
            </form>
        </div>
    </div>
</body>
</html>
