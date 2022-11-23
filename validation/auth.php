<?php
$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);


$password = md5($password."wrgrwrhrh23424t4");

$mysql = new mysqli('localhost','root','root','register_db');

$result=$mysql->query("SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'");
$user = $result->fetch_assoc();

if ($user['name'] == '' ){
    echo "Неправильный логин или пароль";
    exit();
}

setcookie('user', $user['name'], time()+3600, "/");

$mysql->close();
header('Location: /');
?>