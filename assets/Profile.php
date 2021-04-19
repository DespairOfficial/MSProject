<?php 
require '../assets/Header.php';

$user_id = trim($_GET["id"]);
$user = get_user_by_id($user_id);
?>
<script>
    user_id = <?=$user_id?>
</script>
    <img src="../<?=$user['Image']?>" width ="100" alt="">
    <h2><?= $user['Name'] ?></h2>
    <h3>Это страница пользователя <?=$user['Name']?></h3>
    <?if(($_SESSION['user']['Role']=='Admin') and ($user_id!=$_SESSION['user']['id'])):?>
        <div class="row">
            <div class="span6">
            Роль пользователя: 
                <div class="dropdown">
                    <div class="select">
                        <span><?=$user['Role']?></span>
                        <i class="fa fa-chevron-left"></i>
                    </div>
                    <input  value = "<?=$user['Role']?>" id ="UserRole" type="hidden" name="role">
                        <ul class="dropdown-menu">
                            <li id="Student">Student</li>
                            <li id="Teacher">Teacher</li>
                            <li id="Admin">Admin</li>
                        </ul>
                </div>
            </div>
        </div>
        <button id ="edit_user_role">Применить</button>
        <br>
    <?endif;?>
    
    <? $res_arr =  get_my_grades($user_id)?>
    <?foreach($res_arr as $res): ?>
    
        <p><?=( explode('|',$res,)[0])?> - <?=( explode('|',$res,)[1])?></p>
    
    <?endforeach;?>
<?php require '../assets/Footer.php' ?>