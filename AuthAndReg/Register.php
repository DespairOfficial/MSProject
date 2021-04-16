<?php  
session_start();
require_once '../assets/Database.php';
require_once '../assets/Functions.php';
if($_SESSION['user'])
{
    header('Location: ../assets/SelfProfile.php');
}
//class="bg-light text-dark"
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Регистрация</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/styleAuth.css" rel="stylesheet" type="text/css">
</head>
<body>


<form>
    <label>ФИО</label>    
    <input type="text" name ="Full_name" class="" placeholder="Введите полное имя">
    <label>Логин</label>
    <input type="text" name ="Login" class="" placeholder="Введите логин">
    <label>Изображение</label>
    <input name ="Image" type="file">
    <label>Пароль</label>
    <input type="password" name ="Password" class="" placeholder="Введите пароль">
    <label>Подтвердите пароль</label>
    <input type="password" name ="Password_Conformation" class="" placeholder="Подтвердите пароль">
    <button type="submit" class="regbtn">Зарегестрироваться</button>
    <p>
        У вас уже есть аккаунт? - <a href="Auth.php">Авторизируйтесь</a>
    </p>          
    <p class="msg none"></p>
</form>



<script src= "/js/jquery-3.6.0.js"type="text/javascript"></script>
<script src= "/js/app.js"></script>