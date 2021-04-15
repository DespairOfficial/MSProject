<?php 
	session_start();
	 if(!$_SESSION['user'])
	{
		header('Location: ../AuthAndReg/Auth.php');
		die();
	}
require_once 'Database.php';
require_once 'Functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Система</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="../css/styles.css" rel="stylesheet" type="text/css">
	
	<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
	<a class="navbar-brand" style ="margin-left: 10px;"href="../index.php">Home</a>
		<ul class="navbar-nav">
			<li class="nav-item">
			<a class="nav-link" href="../assets/SelfProfile.php">Мой профиль</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" href="../Course/CoursesPage.php">Курсы</a>
			</li>
		</ul>
</nav>
</head>
<body>
<div class="row justify-content-around">
	<div class="col-md-8 border">