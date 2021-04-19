<?php 
session_start();
if($_SESSION['user']['role']=='Studnet')
{
    header('Location: ../AuthAndReg/Auth.php');
    die();
}
require_once '../assets/Database.php';
$paragraph_id = $_POST['paragraph_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$error_fields = [];
if($name == "")
{
    $error_fields[] = 'paragraph_name';
}
if($error_fields == "")
{
    $error_fields[] = 'paragraph_description';
}

if(count($error_fields)!=0)
{
    $responce = ["status"=>false,"fields" => $error_fields, "message"=>"Поля не могут быть пустыми!"];
    echo json_encode($responce);
    die();
}
else
{   global $link;
    $query = "UPDATE paragraphs SET Name = '$name', Description = '$description' WHERE id = '$paragraph_id'";
    mysqli_query($link, $query);
    $responce = ["status"=>true,"message"=>"Изменения применены"];
    echo json_encode($responce);
    die();
}
?>
<?require '../assets/Footer.php'?>