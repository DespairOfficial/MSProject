<?php require 'assets/Header.php' ?>
<?php 
$creator_id = trim($_GET["id"]);
$tickets = get_tickets_by_creator($creator_id);  

?>
    <div class="col-md-9">
                <h1 class="page-header"> Список всех билетов от <?echo $creator_id?> <br></h1>
            <?php foreach ($tickets as $ticket): ?>
                <div class="span2">
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
                            <i class="icon-user"></i> by <a href="ListOfTicketsByCreator.php?id=<?=$ticket['CreatedBy']?>"><?=$ticket['CreatedBy']?></a> 
                        |    <i class="icon-calendar"></i> Sept 16th, 2012
                        |    <i class="fas fa-atom"></i> <a href ="#"><?=$ticket['Theme']?> </a>
                        |   <i class="icon-list"></i> <a href="ListOfTicketsByCreator.php?id=<?=$ticket['CreatedBy']?>">Список билетов этого же автора</a>
                        </p>
                    </div>
                </div>  
                <div class="row">
                    <hr>
                </div>  
            <?php endforeach; ?>
 <?php require 'assets/Footer.php' ?>