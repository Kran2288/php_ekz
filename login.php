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

        // Вытаскиваем из БД запись, у которой логин равняеться введенному
        $query = db_request("SELECT user_id, user_password FROM users WHERE user_login='".db_escape($login)."' LIMIT 1");
        $data = mysqli_fetch_assoc($query);
        // Сравниваем пароли
        if($data['user_password'] === md5(md5($password))){
            // Генерируем случайное число и шифруем его
            $hash = md5(generateCode(10));

            // Переводим IP в строку
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";

            // Записываем в БД новый хеш авторизации и IP
            db_request("UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

            // Ставим куки
            setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
            setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);

            // Переадресовываем браузер на страницу проверки нашего скрипта
            header("Location: index.php"); exit();
        }
        else
        {
            $err[] = 'Вы ввели неправильный логин/пароль';
            $err = json_encode($err);
            header("Location: login.php?error=" . $err); exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-page">
        <div class="form">
            <form action="login.php" method="GET" id="login-form" class="login-form">
                <div class="label-form">
                    <label for="login-form">Авторизация</label>
                </div>
                <input type="text" name="login" placeholder="логин" required>
                <input type="password" name="password" placeholder="пароль" required>
                <button>Войти</button>
                <p class="message">Не зарегистрированы? <a href="signup.php">Создать аккаунт</a></p>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
