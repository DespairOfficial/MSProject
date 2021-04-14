<?php
$link = mysqli_connect('localhost','root','root','ticketsystem');
$ticket_ids = $_POST['result'];
$paragraph_id = $_POST['paragraph_id'];
function RemoveTicketFromParagraph($paragraph_id,$ticket_id)
{ 
    global $link;
    $checkquery = "SELECT * FROM paragraph_tickets WHERE paragraph_id = '$paragraph_id' AND ticket_id = '$ticket_id'";
    $checkres = mysqli_query($link, $checkquery);
    if(mysqli_num_rows($checkres)!=0)
    {
       $query = "DELETE FROM paragraph_tickets WHERE paragraph_id = '$paragraph_id' AND ticket_id = '$ticket_id'";
       mysqli_query($link, $query);
       }
    else 
    {
    }
    
}

foreach($ticket_ids as $id)
{
    RemoveTicketFromParagraph($paragraph_id,$id);
}

$responce = ['status' => 'Succass'];
echo json_encode($responce);