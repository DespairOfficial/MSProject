<?php 
session_start();
require_once '../assets/Database.php';
require_once '../assets/Functions.php';


if(!$_SESSION['user'])
{
    header('Location: ../AuthAndReg/Auth.php');
    die();
}

$paragraph_id = $_SESSION['curr_paragraph'];
if(!(is_student_on_course($_SESSION['user']['id'],$_SESSION['curr_course'])) and ($_SESSION['user']['Role']==='Student'))
{
    header('Location: CoursesPage.php');
}
$student_id = $_SESSION['user']['id'];
$answers = $_POST['result'];
$ids = $_POST['ids'];
$error_fields = [];

for($i = 0; $i<count($ids); $i++)
{
    if($answers[$i]=='')
    {
        $error_fields[] = $ids[$i];
    }
}
if(count($error_fields)>0)
{
    $responce = [
        'status' => '0',"error_fields"=>$error_fields];
    echo json_encode($responce);
    die();
}
$right_answers = 0;
for($i = 0; $i<count($ids); $i++)
{   
    $his_answer = $answers[$i];
    $ticket_id = str_replace('testanswer','',$ids[$i]);
    if(is_answer_right($his_answer,$ticket_id))
    {
        $right_answers+=1;
    } 
}
$amount_of_questions = count($ids);
$test_result = (int)($right_answers/$amount_of_questions *100);

if(!$test_result==0)
{
    for($i = 0; $i<count($ids); $i++)
    {   
        $his_answer = $answers[$i];
        $ticket_id = str_replace('testanswer','',$ids[$i]);
        add_students_answer($student_id,$paragraph_id,$ticket_id,$his_answer); 
    }
    student_passed_test($student_id,$paragraph_id,$test_result);
}
$responce = ['status' => '1',"test_res"=>$test_result];
echo json_encode($responce);
die();


