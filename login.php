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

    <div class="container-fluid">
    <div class="col-md-4 offset-md-4">
    <div class="form-container">
    <div class="form-icon"><i class="fa fa-user"></i></div>
    <form class="form-horizontal" method="post" action="login_process.php">

    <h2 class="title">Авторизация</h2>
    <div class="form-group">
        <label for="login">Логин:</label>
        <input class="form-control" type="text" name="login"  placeholder = "Введите логин..." required><br>
        
    </div>
    <div class="form-group">
        <label for="password">Пароль:</label>
        <input class="form-control" type="password" name="password"  placeholder = "Введите пароль..." required><br>
    </div>
      
        <button type="submit" class="btn btn-default">Войти</button>
    </form>

    <p>Нет аккаунта? <a href="register.php">Зарегистрируйтесь</a>
    </div>
    </div>
</div>
</body>
</html>
