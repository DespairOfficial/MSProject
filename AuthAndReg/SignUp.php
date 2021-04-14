<?php
    session_start();
    require_once '../assets/Database.php';
    require_once '../assets/Functions.php';
    $full_name =  mysqli_real_escape_string($link,$_POST['Full_name']);
    $Login = mysqli_real_escape_string($link,$_POST['Login']);
    $Password = mysqli_real_escape_string($link,$_POST['Password']);
    $Password_Conformation = mysqli_real_escape_string($link,$_POST['Password_Conformation']);

    $isLoginExists = mysqli_query($link, "SELECT * FROM users WHERE Login = '$Login'");

    $error_fields = [];

    if($Login === '' or (mysqli_num_rows($isLoginExists)>0)){
        $error_fields[]= 'Login';
    }
    if($Password === ''){
        $error_fields[]= 'Password';
    }
    if($full_name === ''){
        $error_fields[]= 'Full_name';
    }
    if($Password_Conformation === ''){
        $error_fields[]= 'Password_Conformation';
    }
    if(!$_FILES["Image"]){
        $error_fields[]= 'Image';
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
                "message" => "Проверьте правильность введенных значений",
                "fields" => $error_fields
            ];
    
            echo json_encode($response);
            die();
        }
    }
    if($Password===$Password_Conformation)
    {
        $path = 'uploads/'.time().$_FILES['Image']['name'];
        if(! move_uploaded_file($_FILES['Image']['tmp_name'], './'.$path))
       {
            $response = [
                "status" => false,
                "type" => 2,
                "message" => "Ошибка при загрузке изображения",
             ];
            echo json_encode($response);
        }
        $Password = md5($Password);
       
       $query = "INSERT INTO users (Login, Role, Theme,  Name, Password, Image) VALUES ('$Login', 'Student', NULL, '$full_name', '$Password', '$path')";
       $result = mysqli_query($link, $query);

       $response = [
        "status" => true,
        "message" => "Регистрация прошла успешно!",
        ];
        echo json_encode($response);
    }
    else{
        $response = [
            "status" => false,
            "type" => 3,
            "message" => "Пароли не совпадают",
         ];
        echo json_encode($response);
        die();
    }
