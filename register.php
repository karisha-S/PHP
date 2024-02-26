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
    
    <div class="container-fluid">
    <div class="col-md-4 offset-md-4">
    <div class="form-container">
    <div class="form-icon"><i class="fa fa-user"></i></div>
    <form class="form-horizontal" method="post" action="register_process.php" enctype="multipart/form-data">
    <h2 class="title">Регистрация</h2>
    <div class="form-group">
        <label for="login">Логин:</label>
        <input class="form-control" type="text" name="login" required><br>
</div>
<div class="form-group">
        <label for="password">Пароль:</label>
        <input class="form-control" type="password" name="password" required><br>
</div>
<div class="form-group">
        <label for="email">Email:</label>
        <input class="form-control" type="email" name="email" required><br>
</div>
<div class="form-group">
        <label for="avatar">Выберите аватар (изображение):</label>
        <input  class="form-control" type="file" accept="image/*" name="avatar"><br>
</div>
        <button type="submit" name="register" class="btn btn-default">Зарегистрировать</button>
       
    </form>

    <p>Уже есть аккаунт? <a href="login.php">Войдите</a></p>
    </div>
   </div>
   </div>
   
</body>
</html>
