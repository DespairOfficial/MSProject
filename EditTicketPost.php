<?php

require_once "assets/Database.php";
require_once "assets/Functions.php";

if(isset($_POST["Question"]) and isset($_POST["Answer"]) and isset($_GET["id"]) )
{
    $Question = trim($_POST["Question"]);
    $Answer = trim($_POST["Answer"]);
    $id = trim($_GET["id"]);
    $Theme = trim($_POST["Theme"]);
   
    $uprade_result =  EditTicket($Question, $Answer,$Theme,$id);
    $header = 'Location: /?EditTicketPost=';
    $header.= $uprade_result;
    header($header);

}
else 
{
    header('Location: /');
}
    
    
