<?php
require('db.php');
require("check_auth.php");
if($user_auth == false){
    header("Location: login.php"); exit();
}
setcookie("id", "", time() - 3600*24*30*12, "/");
setcookie("hash", "", time() - 3600*24*30*12, "/",null,null,true);

// Переадресовываем браузер на страницу проверки нашего скрипта
header("Location: login.php"); exit;