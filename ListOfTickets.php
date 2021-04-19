<?php require 'assets/Header.php' ?>

<?php
if($_SESSION['user']['Role']!='Admin')
{
    header('Location: index.php');
    die();
}
$tickets = get_tickets(); 
?>

    <div class = "container-fluid"> 
        <h1 class="page-header"> Список всех билетов</h1>
            <?php foreach ($tickets as $ticket): ?>
                <div class="mb-2 border">
                    <div class="span2" style="padding: 5px;">
                        <a href="#" class="thumbnail">
                            <img class="img-fluid" src="images/ticket.png" width="100" height ="150"  alt="">
                        </a>
                    </div>
                    <div class="row">
                        <div class="span6">
                            <h4><strong><a href="EditTicket.php?id=<?=$ticket['id']?>">Билет№<?=$ticket["id"]?></a></strong></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span6">      
                            <p>
                                <?=$ticket["Question"]?>
                            </p>
                            <a role="button" class="btn btn-success" href="EditTicket.php?id=<?=$ticket['id']?>" value = "Изменить"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span8">
                            <p>
                                 by <a href="./assets/Profile.php?id=<?=get_user_by_id($ticket['CreatedBy'])['id']?>"><?= get_user_by_id($ticket['CreatedBy'])['Name']?> </a> 
                            |     Sept 16th, 2012
                            |    <a href="ListOfTicketsByCreator.php?id=<?=$ticket['CreatedBy']?>">Список билетов этого же автора</a>
                            </p>
                        </div>
                    </div>  
                </div>
            <?php endforeach; ?>
    </div> 

<?php require 'assets/Footer.php' ?>