<?php   

$link = mysqli_connect('localhost','root','root','ticketsystem');

if(mysqli_connect_errno())
{
    echo 'Ошибка подключнения: ('. mysqli_connect_errno() .'): '. mysqli_connect_error();
}



