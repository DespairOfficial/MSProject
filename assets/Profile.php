<?php 
require '../assets/Header.php';

$user_id = trim($_GET["id"]);
$user = get_user_by_id($user_id);
?>
    <img src="<?= $user['Image'] ?>" width ="100" alt="">
    <h2><?= $user['Name'] ?></h2>
    <h3>Это страница пользователя <?=$user['Name']?></h3>
    <h2>Роль пользователя: <?= $user['Role'] ?></h2>
    <a href="../AuthAndReg/Logout.php" style="color: red;">Выход</a>
    <? $res_arr =  get_my_grades($user_id)?>
    <?foreach($res_arr as $res): ?>
    
        <p><?=( explode('|',$res,)[0])?> - <?=( explode('|',$res,)[1])?></p>
    
    <?endforeach;?>
<?php require '../assets/Footer.php' ?>