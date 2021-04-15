<?php
    session_start();
    require_once '../assets/Database.php';
    require_once '../assets/Functions.php';
    $user_id = $_SESSION['user']['id'];
    $full_name =  mysqli_real_escape_string($link,$_POST['Full_name']);
    $login = mysqli_real_escape_string($link,$_POST['Login']);
    $isLoginExists = mysqli_query($link, "SELECT * FROM users WHERE Login = '$login' and id != $user_id");
    $error_fields = [];

    if($login === '' or (mysqli_num_rows($isLoginExists)>0)){
        $error_fields[]= 'login_edit';
    }
    if($full_name === ''){
        $error_fields[]= 'full_name_edit';
    }
    if(!$_FILES["Image"]){
        $error_fields[]= 'ImageEdit';
    }
    if(!empty($error_fields))
    {
        if((mysqli_num_rows($isLoginExists)>0))
        {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => "Пользователь с таким именем уже сущесвует!",
                "fields" => $error_fields
            ];
            echo json_encode($response);
            die();
        }
        else{
            $response = [
                "status" => false,
                "type" => 1,
                "message" => "Поля не должны быть пустыми!",
                "fields" => $error_fields
            ];
    
            echo json_encode($response);
            die();
        }
    }
    var_dump($_FILES['Image']);
    $path = 'uploads/'.time().$_FILES['Image']['name'];
    if(!move_uploaded_file($_FILES['Image']['tmp_name'], '../'.$path))
    {
        $response = [
            "status" => false,
            "type" => 2,
            "message" => "Ошибка при загрузке изображения",
            ];
        echo json_encode($response);
    }
    $Password = md5($Password);
    
    $query = "UPDATE users SET Login = '$login',  Name = '$full_name', Image = '$path' WHERE id = '$user_id'";
    $result = mysqli_query($link, $query);
    $response = [
    "status" => true,
    "message" => "Профиль изменен",
    ];
    echo json_encode($response);
