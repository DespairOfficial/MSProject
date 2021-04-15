<?php 
require 'assets/Header.php';

ini_set ('error_reporting','E_All');
ini_set ('display_errors','E_All');
ini_set ('display_startup_errors','E_All');
$users = get_users();
?>
<div class = "container-fluid"> 
        <h1 class="page-header"> Список всех пользователей</h1>
            <?php foreach ($users as $user): ?>
                <div class="my-5 border" style="height: 120px">
                    <div class="span2">
                        <a href="#" class="thumbnail">
                            <img style="" class="img-fluid" src="<?=$user['Image']?>" width="100" height ="100"  alt="">
                        </a>
                    </div>
                    <div class="row">
                        <div class="span6">
                            <h4><strong><a href="assets/Profile.php?id=<?=$user["id"]?>">User: <?=$user["id"]?></a></strong></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span6">
                            <h4><strong>User: <?=$user["Name"]?></a></strong></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span6">      
                            <p>
                                <?=$user["Question"]?>
                            </p>
                            <a role="button" class="btn btn-success" href="" value = "Изменить"></a>
                        </div>
                    </div>
                    
                </div>
            <?php endforeach; ?>
    </div> 

<?php require 'assets/Footer.php' ?>
