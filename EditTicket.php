<?php 


require 'assets/Header.php'; ?>
<?php 


$ticket_id = $_GET['id'];    //получаем id билета из строки запроса(из глобального get массива)
$ticket =  get_ticket_by_id($ticket_id); //получаем массив данных билета по id
?>
 <div class="span8">
    <p>
    <div class="row">
                <div class="span6">
                    <h4><strong>Билет№<?=$ticket["id"]?></a></strong></h4>
                </div>
            </div>
    <form action="EditTicketPost.php?id=<?=$ticket['id']?>" method="post">
        <label>Вопрос:</label><br>
        <div class="row">
            <div class="span6">      
                <p> <input type="text" name="Question"  value="<?=$ticket["Question"]?>" required><br> </p>
            </div>
        </div>
        <label>Ответ:</label><br>
        <div class="row">
            <div class="span6">      
                <p> <input type="text" name="Answer" value="<?=$ticket["Answer"]?>" required><br> </p>
            </div>
        </div>
        <label>Тема:</label><br>
        <div class="row">
            <div class="span6">      
                <p> <input type="text" name="Theme" value="<?=$ticket["Theme"]?>" required><br> </p>
            </div>
        </div>
        <div class="row">
            <div class="span6">      
                <p> <input class="btn btn-success" type="submit" value="Изменить"><br> </p>
            </div>
        </div>
    </form>

                <i class="icon-user"></i> by <a href="ListOfTicketsByCreator.php?id=<?=$ticket['CreatedBy']?>"><?=$ticket['CreatedBy']?></a>  
            |    <i class="icon-calendar"></i> Sept 16th, 2012
    </p>
</div>   

<?php require 'assets/Footer.php' ?>