<?php
session_start();
require '../assets/Header.php';

?>
    <form action="">
    
    <div class = "container-fluid">
        <h4><?echo $_SESSION['user']['Name'] ?></h4>
        <img src="<?= $_SESSION['user']['Image'] ?>" width ="100" alt="">
    </div>
    
    
    <?if($_SESSION['user']['Role']=='Student'): ?>
    <p>Ваши оценки:</p>
    <? $res_arr =  get_my_grades($_SESSION['user']['id']);?>
    <?foreach($res_arr as $res): ?>
    
        <p><?=( explode('|',$res,)[0])?> - <?=( explode('|',$res,)[1])?></p>
    
    <?endforeach;?>
    <?endif;?>
    <a href="/AuthAndReg/Logout.php" style="color: red;">Выход</a>
    </form>
<?php require '../assets/Footer.php' ?>