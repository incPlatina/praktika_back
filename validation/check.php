<?php
$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
$name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

if(mb_strlen($login) < 3 || mb_strlen($login)>90){
    $login='no';
    header("Location: /Авторизация.php?login=$login");
    exit();
} else if (mb_strlen($name) < 2 || mb_strlen($name)>50){
    $name='no';
    header("Location: /Авторизация.php?name=$name");
    exit();
}else if (mb_strlen($password) < 3 || mb_strlen($password)>50){
    $password='no';
    header("Location: /Авторизация.php?password=$password");
    exit();
}
$password = md5($password."wrgrwrhrh23424t4");
$mysql = new mysqli('localhost','root','root','register_db');

$result=$mysql->query("SELECT * FROM `users` WHERE `login`='$login'");
$user = $result->fetch_assoc();
if ($user['login'] == $login ){
    $login='have';
    header("Location: /Авторизация.php?login=$login");
    exit();
}

$mysql->query("INSERT INTO `users` (`login`,`password`,`name`)
VALUES('$login','$password','$name')");

$mysql->close();
header('Location: /Авторизация.php');
?>