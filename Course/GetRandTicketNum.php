<?php 
session_start();
require '../assets/Database.php';
if($_SESSION['user']['role']=='Studnet')
{
    header('Location: ../AuthAndReg/Auth.php');
    die();
}
$paragraph_id = $_POST['paragraph_id'];
global $link;
$query = "SELECT NumRandTickets FROM paragraphs WHERE paragraph_id = '$paragraph_id'";
$result = mysqli_query($link, $query);
$tickets = mysqli_fetch_assoc($result);
$count = $tickets['NumRandTickets'];

$responce = ["tickets_in_course"=>$count];
echo json_encode($responce);