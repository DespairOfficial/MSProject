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
	<title>Система</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/styleAuth.css" rel="stylesheet" type="text/css">
</head>
<body>


<form>
    <label>Логин</label>
    <input type="text" name = "Login" required placeholder="Введите логин">
    <label>Пароль</label>
    <input type="password" name="Password" reqired placeholder="Введите пароль">
    <button type="submit" class="logbtn">Войти</button>
    <p>
        У вас нет аккаута? - <a href="Register.php">Регистрация</a>
    </p>
    <p class="msg none"></p> 
</form>

<?php  require '../assets/Footer.php' ?>