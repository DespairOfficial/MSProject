<?php
session_start();
if($_SESSION['user']['Role']!='Admin')
{
    header('Location: index.php');
    die();
}
include 'assets/Database.php';
$user_id=$_POST['id'];
$user_role = $_POST['role'];
if($_SESSION['user']['Role']!='Admin')

$query = "UPDATE users SET Role = '$user_role' WHERE id = '$user_id'";
global $link;
mysqli_query($link, $query);
