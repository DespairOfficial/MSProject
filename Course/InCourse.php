<?php 
$course_id = trim($_GET["id"]);
require '../assets/Header.php';
session_start();
if(!(is_student_on_course($_SESSION['user']['id'],$course_id)) and ($_SESSION['user']['Role']==='Student'))
{
    header('Location: CoursesPage.php');
}
$paragraphs = get_paragraphs_by_owner_id($course_id);
$counter = 0;
$_SESSION['curr_course'] = $course_id;
?>
<script>
    course_id = <?=$course_id?>
</script>
<div class="container-fluid">
    <div class="row">
        <?php foreach ($paragraphs as $paragraph): ?>
            <? $counter+=1?>
            <?php if($counter%2==0):?>
                    <div class="row" style="margin: 10px;">
            <?php else: ?>   
                <div class="row oddParagraph" style="margin: 10px;">
            <?php endif; ?>
                    <div class="col-12">
                        <h3> <?=$paragraph['Name']?></h3>
                        <div style="margin-left: 50px; margin-bottom: 30px;">
                            <p class="card-text">
                                <?=$paragraph['Description']?>
                            </p>
                            <? if($_SESSION['user']['Role']=='Student'):?>
                                <? if(!is_student_passed_test($_SESSION['user']['id'],$paragraph['id'])):?>
                                    <p class="card-text">
                                    <a href="StartTest.php?id=<?=$paragraph['id']?>">Пройти тест</a>   
                                    </p>
                                <?else: ?>
                                    <p class="card-text">
                                    Вы уже прошли этот тест  
                                    </p>
                                <?endif;?>
                            <?endif;?>
                            <?if((($_SESSION['user']['id'])==(get_owner_id_by_course($course_id))) or ($_SESSION['user']['Role'])=='Admin'):?>
                            <p>
                                <a href="EditParagraph.php?id=<?=$paragraph['id']?>">Редактировать тест</a>   
                            </p>
                            <p>
                                <label for="rand_num_tickets">Выбрать количество случайных билетов для теста из <?=amount_tickets_by_par_id($paragraph['id'])?></label>  <input class = 'oddinput rand_num_tickets' id = "rand_num_tickets<?=$paragraph['id']?>" min="0" max = "<?=amount_tickets_by_par_id($paragraph['id'])?>" type="number">    
                            </p>
                            <p class='RndMsg<?=$paragraph['id']?>'>
                                
                            </p>
                            <?endif;?>
                        </div>
                        
                    </div>
                    
            </div>
            
        <?php endforeach;  ?>
        <?if((($_SESSION['user']['id'])==(get_owner_id_by_course($course_id))) or ($_SESSION['user']['Role'])=='Admin'):?>
        <button id = "addparagraph">Добавить</button>
        <?endif;?>
    </div>
</div>

<?php require '../assets/Footer.php' ?>