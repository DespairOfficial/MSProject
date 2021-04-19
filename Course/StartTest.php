<?php
session_start();
$paragraph_id = trim($_GET["id"]);
require '../assets/Header.php';
if(!(is_student_on_course($_SESSION['user']['id'],$_SESSION['curr_course'])) and ($_SESSION['user']['Role']==='Student'))
{
    header('Location: CoursesPage.php');
}
$tickets = get_tickets_by_paragraph($paragraph_id);
$rnd_num = (int)get_paragraph_by_id($paragraph_id)['RandTickets'];
$_SESSION['curr_paragraph'] = $paragraph_id;
$ticket_pool = [];
if($rnd_num==0)
{
    $ticket_pool = $tickets;
}
else{
    foreach(array_rand($tickets,$rnd_num) as $rnd)
        {
            $ticket_pool[] = $tickets[$rnd];
        }
}


?>
<form>
    <?foreach ($ticket_pool as $ticket):?>
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