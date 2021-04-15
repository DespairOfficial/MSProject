<?php
session_start();
$link = mysqli_connect('localhost','root','root','ticketsystem');
$Name = $_POST['Name'];
$Description = $_POST['Description'];
$OwnerCourse = $_SESSION['curr_course'];
var_dump($Name);
var_dump($Description);
var_dump($OwnerCourse);
$query = "INSERT INTO paragraphs (Name ,Description,OwnerCourse) VALUES ( '$Name','$Description','$OwnerCourse')";
mysqli_query($link, $query);
/*header('Location: InCourse/?id='+$OwnerCourse'.php');*/
?>