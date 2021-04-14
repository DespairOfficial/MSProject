<?php
    session_start();
    require_once '../assets/Database.php';
    require_once '../assets/Functions.php';
    $Login = $_POST['Login'];
    $Password = $_POST['Password'];

    $error_fields = [];

    if($Login === ''){
        $error_fields[]= 'Login';
    }
    if($Password === ''){
        $error_fields[]= 'Password';
    }

    if(!empty($error_fields))
    {
        $response = [
            "status" => false,
            "type" => 1,
            "message" => "Проверьте правильность введенных значений",
            "fields" => $error_fields
        ];

        echo json_encode($response);
        die();
    }


    $Password = md5($Password);
    $find_query = "SELECT * FROM users WHERE Login = '$Login' AND Password = '$Password'";
    $find_user = mysqli_query($link,$find_query);
    
    if(mysqli_num_rows($find_user)>0)
    {
        $user = mysqli_fetch_assoc($find_user);
        $_SESSION['user'] = [
            "id" => $user['id'],
            "Name" => $user['Name'],
            "Login" => $user['Login'],
            "Role"=> $user['Role'],
            "Image"=> $user['Image']
        ];


        $response = [
            "status" => true
        ];

        echo json_encode($response);
    } else{
        $response = [
            "status" => false,
            "message"=>"Не верный логин или пароль"
        ];
        echo json_encode($response);
    }