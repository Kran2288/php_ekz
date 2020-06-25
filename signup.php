<?php
    require('db.php');
    require("check_auth.php");
    if($user_auth == true){
        header("Location: index.php"); exit();
    }
    $login = $_GET['login'];
    $password = $_GET['password'];
    if($login && $password){
        require('hash.php');
        $err = [];

        // проверям логин
        if(!preg_match("/^[a-zA-Z0-9]+$/", $login)){
          $err[] = "Логин может состоять только из букв английского алфавита и цифр";
        }
        $length_login = strlen($login) - 1;
        if($length_login < 3 or $length_login > 30){
          $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
        }
        $query = db_request("SELECT user_id FROM users WHERE user_login='".db_escape($login)."'");
        if(mysqli_num_rows($query) > 0){
            $err[] = "Пользователь с таким логином уже существует в базе данных";
        }

        // Если нет ошибок, то добавляем в БД нового пользователя
        if(count($err) == 0){
            // Убераем лишние пробелы и делаем двойное хеширование
            $password = md5(md5(trim($password)));

            db_request("INSERT INTO users SET user_login='".$login."', user_password='".$password."'");
            header("Location: login.php"); exit();
        }
        else{
            $err = json_encode($err);
            header("Location: signup.php?error=" . $err); exit();
        }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-page">
        <div class="form">
            <form action="signup.php" method="GET" id="register-form" class="register-form">
            <div class="label-form">
                <label for="register-form">Регистрация</label>
            </div>
            <input type="text" name="login" placeholder="логин" required>
            <input type="password" name="password" placeholder="пароль" required>
            <button>Создать</button>
            <p class="message">Уже зарегистрированы? <a href="login.php">Войти</a></p>
            </form>
        </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
