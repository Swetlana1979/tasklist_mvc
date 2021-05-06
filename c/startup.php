<?php


define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'tasklist');

//require("constants.php");
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// проверка соединения
if (!$con) {
   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
   exit;
}
session_start();







		

