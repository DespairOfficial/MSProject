<?php 
require 'assets/Header.php';
if($_SESSION['user']['Role']!='Admin')
{
    header('Location: index.php');
    die();
}
$users = get_users();
?>
<div class = "container-fluid"> 
        <h1 class="page-header"> Список всех пользователей</h1>
            <?php foreach ($users as $user): ?>
                <div class="my-5 border" >
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
                            <h4><strong>Role: <?=$user["Role"]?></a></strong></h4>
                        </div>
                    </div>                      
                </div>
            <?php endforeach; ?>
    </div> 

<?php require 'assets/Footer.php' ?>
