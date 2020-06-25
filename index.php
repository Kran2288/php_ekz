<?php
require('db.php');
if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
    $query = db_request("SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '" . intval($_COOKIE['id']) . "' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);
    if($userdata['admin'] == 1){
        header("Location: backend/index.php"); exit();
    }
}

?>
