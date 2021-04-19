<?php 
session_start();
require '../assets/Database.php';
if($_SESSION['user']['role']=='Studnet')
{
    header('Location: ../AuthAndReg/Auth.php');
    die();
}
$paragraph_id = $_POST['id'];
$num = $_POST['num'];
global $link;
$query = "UPDATE paragraphs SET RandTickets = '$num' WHERE id = '$paragraph_id'";
mysqli_query($link, $query);
if($num==0)
{
    $responce= ["status"=>0,"message"=>"При значении 0, будут выданы все выбранные билеты из темы"];
    echo json_encode($responce);
    die();
}
