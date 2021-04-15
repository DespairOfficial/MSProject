<?php
require_once "assets/Database.php";
require_once "assets/Functions.php";

if(isset($_POST["Question"]) and isset($_POST["Answer"]) and isset($_GET["id"]) )
{
    $Question = trim($_POST["Question"]);
    $Answer = trim($_POST["Answer"]);
    $id = trim($_GET["id"]);
   
    $uprade_result =  EditTicket($Question, $Answer,$id);
    header('Location: /');
}
else 
{
    header('Location: /');
}
    
    
