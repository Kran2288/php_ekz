<?php
$db = mysqli_connect('localhost', 'root', '', 'ekz');

if ($db == false){
    print_r("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    die;
}
mysqli_set_charset($db, "utf8");

function db_request($sql){
	global $db;
	$result = mysqli_query($db, $sql);
	if ($result == false) {
		print_r("Произошла ошибка при выполнении запроса ". mysqli_error($db));
		die;
	}
	return $result;
}
function db_escape($str){
    global $db;
    $result = mysqli_real_escape_string($db, $str);
    return $result;
}

