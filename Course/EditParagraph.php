<?php 
session_start();
if($_SESSION['user']['role']=='Studnet')
{
    header('Location: ../AuthAndReg/Auth.php');
    die();
}
require '../assets/Header.php';

$paragraph_id = trim($_GET["id"]);
$paragraph = get_paragraph_by_id($paragraph_id);
$course_id = get_courseID_by_paragraph($paragraph);
?>
<script>
    let paragraph_id = <?=$paragraph_id?>
</script>
<div class="container-fluid">
    <div class="row">
        <form action="post">
            <div class="row" style="margin: 10px;">
                <div class="col-12">
                <label>Заголовок темы:</label>
                <input type="text" style="width: 100%; height: 40px;" value="<?=$paragraph['Name']?>"> 
                    <div style="margin-left: 50px; margin-bottom: 30px;">
                    <p>
                    <label>Описание темы:</label>
                        <textarea rows="5" style ="resize: both; width: 100%;" name="Description" > <?=$paragraph['Description']?> </textarea>
                    </p> 
                    </div>
                </div>
                <div>
                    <label>Добавить новый билет в тему</label>
                    <br>
                    <form>
                        <label >Вопрос: </label>
                        <input type="text" name="Question">
                        <label >Ответ: </label>
                        <input name = "Answer" type="text">
                        <button id="addnewticket">Добавить</button>
                        <p id ="addedmessage">Пока ничего</p>
                    </form>
                </div>
                <div class="row justify-content-around">
                    <div class="col-5 border">
                        Билеты в этой теме: 
                        <?$paragraph_tickets = get_tickets_by_paragraph($paragraph_id);?>
                        <div class="containter-fluid" id ="paragraphtickets">
                            <?php foreach($paragraph_tickets as $ticket):?> 
                                <div class="row border" id="row<?=$ticket['id']?>" onclick="mark_this_to_remove(<?=$ticket['id']?>)">
                                        <label name = 'Question' >Вопрос: <?=$ticket['Question']?></label>
                                        <label name= 'Answer' >Ответ: <?=$ticket['Answer']?></label>
                                        <label name='id' >Номер билета: <?=$ticket['id']?></label>
                                </div>
                            <?endforeach;?>
                        </div>
                    </div>
                    <div class="col-2 border">
                        <button type="button" class="btn btn-left" onclick="AddToParagraph()">Добавить</button>
                        <button type="button" class="btn btn-right" onclick="RemoveFromParagraph()">Убрать</button>
                    </div>
                    <div class="col-5 border"> Все билеты:
                        <?$tickets = get_tickets_by_course_not_in_paragraph($paragraph['OwnerCourse'],$paragraph['id']);?>
                        <div class="containter-fluid" id ="coursetickets">
                            <?php foreach($tickets as $ticket):?> 
                                <div class="row border" id="row<?=$ticket['id']?>" onclick="mark_this_to_paragraph(<?=$ticket['id']?>)">
                                        <label name = 'Question' >Вопрос: <?=$ticket['Question']?></label>
                                        <label name= 'Answer' >Ответ: <?=$ticket['Answer']?></label>
                                        <label name='id' >Номер билета: <?=$ticket['id']?></label>
                                </div>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </form>             
    </div>
</div>

<?php require '../assets/Footer.php' ?>