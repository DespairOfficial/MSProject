<?php 
 session_start();
 require_once '../assets/Database.php';
 require_once '../assets/Functions.php';
 $code_word_input = $_POST['code_word_input'];
 $id_Course = $_POST['id_course'];
 $id_Student = $_SESSION['user']['id'];
 $code_word = get_code_word_by_course($id_Course);
?>
<?
if($code_word_input===$code_word)
{
    $code_word_suits = true;
}   
else
{
    $code_word_suits = false;
}
    

 if($code_word_suits) //  $code_word_suits
    {   
        $insert_query = "INSERT INTO course_student (id_Course, id_Student) VALUES ('$id_Course','$id_Student')";
        $insertresult = mysqli_query($link, $insert_query);
        $response = [
            "status" => true,
            "message" => "Вы зарегестрировались на курс!",
            "course_id" => $id_Course
        ];
        echo json_encode($response);
        die();
        
    }
    else
    {
        $response = [
            "status" => false,
            "message" => "Кодовое слово введено не верно!"
        ];
        echo json_encode($response);
        die();
    }
?>

<?php require '../assets/Footer.php' ?>