<?php 

require '../assets/Header.php';

$courses = get_courses();
$counter = 0;
?>

<div class="container-fluid">
    <div class="row">
        <?php foreach ($courses as $course): ?>
            <? $counter+=1?>
                <?php if($counter%2==0):?>
                    <div class="row" style="margin:10px; padding: 10px;">
                <?php else: ?>   
                    <div class="row oddParagraph" style="margin:10px; padding: 10px;">
                <?php endif; ?>
                <? if(($_SESSION['user']['Role']=='Student') and (!is_student_on_course($_SESSION['user']['id'],$course['id']))):?>
                    <h2><?=$course['Name']?> </h2>
                <?else:?>
                    <h2><a href="InCourse.php?id=<?=$course['id']?>"> <?=$course['Name']?> </a></h2>
                <?endif;?>
                
                <p class="card-text">
                    <?=$course['Description']?>
                </p>
                <p class="card-text">
                    Преподаватель:<i class="icon-user"></i><a href="../assets/Profile.php?id=<?=get_user_by_id($course['TeacherId'])['id']?>"><?= get_user_by_id($course['TeacherId'])['Name']?> </a>
                </p>
                <? if(($_SESSION['user']['Role']=='Student') and (!is_student_on_course($_SESSION['user']['id'],$course['id']))):?>
                    <a href="SignOnCourse.php?id=<?=$course['id']?>">Записаться на курс</a>
                <? endif; ?>
            </div>
        <?php endforeach;  ?>
     </div>
</div>

<?php require '../assets/Footer.php' ?>