<?php
session_start();
$paragraph_id = trim($_GET["id"]);
require '../assets/Header.php';
if(!(is_student_on_course($_SESSION['user']['id'],$_SESSION['curr_course'])) and ($_SESSION['user']['Role']==='Student'))
{
    header('Location: CoursesPage.php');
}
$tickets = get_tickets_by_paragraph($paragraph_id);
$_SESSION['curr_paragraph'] = $paragraph_id;
?>
<form>
    <?foreach ($tickets as $ticket):?>
    <div class="row">
        <div class="border col-12">
            <label><?=$ticket['Question']?></label>
            <input type="text" class = "inputanswer" id = "testanswer<?=$ticket['id']?>">
        </div>
    </div>
    
    <?endforeach;?>
    <button id="endtestbutton">Отправить</button>
    <p id="testresult"></p>
</form>

<?php require '../assets/Footer.php' ?>