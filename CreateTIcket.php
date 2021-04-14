<?php
session_start();
require_once 'assets/Database.php';
require_once 'assets/Functions.php';
$answer = $_POST['answer'];
$question = $_POST['question'];
$paragraph = $_POST['paragraph'];
$created_by = $_SESSION['user']['id'];
$error_fields = [];
if($answer=='')
{
    $error_fields[] = 'Answer';
}
if($question=='')
{
    $error_fields[] = 'Question';
}
if(count($error_fields)==0)
{
    add_new_ticket($question,$answer,$paragraph,$created_by);
    $responce = [
        'status' =>true,
        "message"=>"Билет успешно добавлен"];
    
    echo json_encode($responce);
    die();
}
else{
    $responce = ['status' =>false, "message"=>"Поля не должны быть пустыми", "error_fields"=>$error_fields];
    echo json_encode($responce);
    die();
}
?>

