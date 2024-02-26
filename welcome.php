<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Добро пожаловать</title>
</head>
<body>

<div class="container-fluid">
<div class="col-md-4 offset-md-4">
<div class="form-container">
      <form class="form-horizontal" method="post" action="">
                        <div class="mb-3"> <!-- Added Bootstrap margin-bottom class -->
                            <label for="birthday" class="form-label">Введите вашу дату рождения:</label>
                            <input type="date" name="birthday" class="form-control" required> <!-- Added Bootstrap form-control class -->
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button> <!-- Added Bootstrap button classes -->
                    </form>
   
      


<?php
session_start();

function incrementCounter() {
    $counterFile = 'counter.txt';
    $counter = (int)file_get_contents($counterFile);
    $counter++;
    file_put_contents($counterFile, $counter);
}

function getVisitCounter() {
    $counterFile = 'counter.txt';
    return (int)file_get_contents($counterFile);
}

function pluralForm($number, $forms) {
    $number = abs($number) % 100;
    $remainder = $number % 10;

    if ($number > 10 && $number < 20) {
        return $forms[2];
    }

    if ($remainder > 1 && $remainder < 5) {
        return $forms[1];
    }

    if ($remainder == 1) {
        return $forms[0];
    }

    return $forms[2];
}

incrementCounter();
$visitCounter = getVisitCounter();
include('db.php');

$birthdayCookieName = 'user_birthday';

if (!isset($_COOKIE[$birthdayCookieName])) {

    $birthday = isset($_SESSION['user_birthday']) ? $_SESSION['user_birthday'] : '';

    if (empty($birthday)) {
        exit;
    } else {
        setcookie($birthdayCookieName, $birthday, time() + (365 * 24 * 60 * 60)); 
    }
}

if (isset($_POST['birthday'])) {

    $_SESSION['user_birthday'] = $_POST['birthday'];
    setcookie($birthdayCookieName, $_POST['birthday'], time() + (365 * 24 * 60 * 60)); 
    header('Location: ' . $_SERVER['PHP_SELF']); 
    exit;
}

$userBirthday = strtotime($_COOKIE[$birthdayCookieName]);
$today = strtotime('today');
$daysUntilBirthday = ceil(($userBirthday - $today) / (60 * 60 * 24));



if ($daysUntilBirthday == 0) {
    echo '<center><h5 class="mb-4">С днем рождения! Поздравляем!🎉🎉🎉</h5>';
} elseif ($daysUntilBirthday < 0) {
    echo '<center><h5 class="mb-4">День рождения прошёл!</h5>';
} else {
    echo "<center><h5 class='mb-4'>До вашего дня рождения осталось $daysUntilBirthday " . pluralForm($daysUntilBirthday, ['день', 'дня', 'дней']) . "</h5>";
}




if (isset($_SESSION["login"])) {
    $login = $_SESSION["login"];
    $sql = "SELECT * FROM user_data WHERE login = '$login'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<div class="image-container"><img src="' . $row['avatar'] . '" alt="Изображение пользователя" class="img-fluid" style="max-width: 200px; margin-top: 20px;"></div>';
       
        echo '<h6 style="margin-top: 20px;">Добро пожаловать, ' . $row["login"] . '!</h6>';
    }
}

if (!isset($_SESSION['visit_time'])) {
    $_SESSION['visit_time'] = time();
    $curTime=new DateTime();
    $interval=$curTime->diff($_SESSION['vizit_time']);
$stringInterval=$interval->format("%s");
}

$secondsAgo = time() - $_SESSION['visit_time'];
echo "<b class='mb-4'>Вы зашли на сайт $secondsAgo " . pluralForm($secondsAgo, ['секунда', 'секунды', 'секунд']) . " назад.</b><br>";

echo "Вы посетили наш сайт $visitCounter " . pluralForm($visitCounter, ['раз', 'раза', 'раз']) . "!<p>";

// $timeS=(isset($_SESSION['time'][$userID])) ? $_SESSION['time'][$userID] : new DateTime();
    // $_SESSION['time'][$userID]=$timeS;
// 
    // $curTime=new DateTime();
    // $interval=$curTime->diff($_SESSION['time'][$userID]);
    // $stringInterval=$interval->format("%s");
// 
    // echo "<br><span class='font-size=20px;color:gray'><i>You entered this site <strong>" . $stringInterval . "</strong> seconds ago</i></span>";
// $conn->close();
?>
<p><a  href="edit_profile.php"class="btn btn-secondary mx-3">Изменить</a>
<a  href="login.php" class="btn btn-secondary">Выйти из профиля</a>

 </div>
    </div>
</body>
</html>