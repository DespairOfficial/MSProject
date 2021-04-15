<?php
session_start();
require '../assets/Header.php';

?>
    <div class="container-fluid">
        <div class = "row" style="margin-top: 1em;">
            <div class="col-3 ">
                <img src="../<?=$_SESSION['user']['Image']?>" width ="150" alt="">
            </div>
            <div class="col-3 " style="padding: 3em 2em;">
            <h4><?echo $_SESSION['user']['Name'] ?></h4>
            </div>
            
            
        </div>
        
        
        <?if($_SESSION['user']['Role']=='Student'): ?>
        <p>Ваши оценки:</p>
        <? $res_arr =  get_my_grades($_SESSION['user']['id']);?>
        <?foreach($res_arr as $res): ?>
        
            <p style="margin-left: 20px;"><?=( explode('|',$res,)[0])?> - <?=( explode('|',$res,)[1])?></p>
        
        <?endforeach;?>
        <?endif;?>
        <a href="EditProfile.php" style="color: blue;">Редактировать профиль</a><br>
        <a href="/AuthAndReg/Logout.php" style="color: red;">Выход</a>  
    </div>
<?php require '../assets/Footer.php' ?>