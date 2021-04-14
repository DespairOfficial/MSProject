<?php 
function get_tickets()
{
    global $link;
    $query = "SELECT * FROM tickets";
    
    $result = mysqli_query($link, $query);

    $tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $tickets;
}

function get_courses()
{
    global $link;
    $query = "SELECT * FROM courses";
    
    $result = mysqli_query($link, $query);

    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $courses; 
}
function get_users()
{
    global $link;
    $query = "SELECT * FROM users";
    
    $result = mysqli_query($link, $query);

    $tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $tickets;
}
function get_tickets_by_paragraph($paragraph_id)
{
    global $link;
    $query = "SELECT id, Question, Answer, Edited, CreatedBy, CourseId FROM tickets INNER JOIN paragraph_tickets ON tickets.id = paragraph_tickets.ticket_id WHERE `paragraph_id` = '$paragraph_id'";
    $result = mysqli_query($link, $query);
    $paragraph_tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $paragraph_tickets;
}


function get_paragraphs_by_owner_id($owner_id)
{
    global $link;
    
    $query = "SELECT * FROM paragraphs WHERE OwnerCourse='$owner_id'";
    $result = mysqli_query($link, $query);
    $paragraphs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $paragraphs;
}

function get_tickets_by_creator($creator_id)
{
    global $link;
    $creator_id = (int)$creator_id;
    $query = 'SELECT * FROM tickets WHERE CreatedBy='."$creator_id";
    $result = mysqli_query($link, $query);
    $tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $tickets;
}

function get_tickets_by_course_not_in_paragraph($course_id, $paragraph_id )
{
    global $link;
    $course_id = (int)$course_id;
    $paragraph_id = (int)$paragraph_id;

    $query = "SELECT * FROM tickets LEFT JOIN paragraph_tickets ON paragraph_tickets.ticket_id = tickets.id WHERE tickets.CourseId = '$course_id' AND paragraph_tickets.paragraph_id is NULL";
    $result = mysqli_query($link, $query);
    $tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $tickets;
}
function get_courseID_by_paragraph($paragraph_id)
{
    global $link;
    $paragraph_id = (int)$paragraph_id;
    $query = "SELECT OwnerCourse FROM paragraphs WHERE id='$paragraph_id'";
    $result = mysqli_query($link, $query);
    $course_id_array = mysqli_fetch_assoc($result);
    $course_id = $course_id_array['OwnerCourse'];
    return $course_id;
}
function get_code_word_by_course($course_id)
{
    global $link;
    $course_id = (int)$course_id;

    $query = "SELECT CodeWord FROM courses WHERE id ='$course_id'";
    $result = mysqli_query($link, $query);
    $code_word_array = mysqli_fetch_assoc($result);
    $code_word = $code_word_array["CodeWord"];
    return $code_word;
}

function get_user_by_id($user_id)
{
    global $link;
    
    $query = "SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);
    return $user;
}
function get_paragraph_by_id($paragraph_id)
{
    global $link;
    
    $query = "SELECT * FROM paragraphs WHERE id='$paragraph_id'";
    $result = mysqli_query($link, $query);
    $paragraph = mysqli_fetch_assoc($result);
    return $paragraph;
}

function get_ticket_by_id($ticket_id)
{
    global $link;

    $query = 'SELECT * FROM  tickets WHERE id ='."$ticket_id";
    $result = mysqli_query($link, $query);
    $ticket = mysqli_fetch_assoc($result);
    return $ticket;
}
function get_course_by_id($course_id)
{
    global $link;

    $query = "SELECT * FROM  courses WHERE id ="."$course_id";
    $result = mysqli_query($link, $query);
    $course = mysqli_fetch_assoc($result);
    return $course;
}




function EditTicket($Question, $Answer,$Theme,$ticket_id)
{
    global $link;
    $Question = mysqli_real_escape_string($link, $Question);
    $Answer = mysqli_real_escape_string($link, $Answer);
    $Theme = mysqli_real_escape_string($link, $Theme);
    $ticket_id = mysqli_real_escape_string($link, $ticket_id);
    $ticket_id = (int) $ticket_id;
    $select_query = 'SELECT * FROM tickets WHERE id='."$ticket_id";
    $search_result = mysqli_query($link, $select_query);
    if($search_result)
    {
        $update_query = 'UPDATE tickets SET Question ="'."$Question".'", Answer ="'."$Answer".'" ,Theme ="'."$Theme".'" WHERE id='."$ticket_id";
        var_dump($update_query);
    }
    else return 'error';
    $update_result = mysqli_query($link, $update_query);
    if($update_result)
    {
        return 'Success';
    }
    
    return $tickets;  
}
function sign_student_on_course($student_id, $course_id)
{
    global $link;

    $insert_query = "INSERT INTO course_student (id_Course, id_Student) VALUES ('$id_Course','$id_Student')";
    $insertresult = mysqli_query($link, $insert_query);
    
}
function is_student_on_course($student_id, $course_id)
{
    global $link;
    $insert_query = "SELECT * FROM `course_student` WHERE id_Student = '$student_id' AND id_Course = '$course_id'";
    $insertresult = mysqli_query($link, $insert_query);
    if(mysqli_num_rows($insertresult)==0)
    {
        return false;
    }
    else return true;
}

function add_students_answer($student_id,$paragraph_id,$ticket_id,$his_answer)
{
    global $link;
    $query = "INSERT INTO test_results (student_id,paragraph_id,ticket_id,his_answer) VALUES ('$student_id','$paragraph_id','$ticket_id','$his_answer')";
    mysqli_query($link, $query);
}

function student_passed_test($student_id,$paragraph_id)
{
    global $link;
    $query = "INSERT INTO passed_tests (student_id,paragraph_id) VALUES ('$student_id','$paragraph_id')";
    mysqli_query($link, $query);
}

function is_student_passed_test($student_id,$paragraph_id)
{
    global $link;
    $query = "SELECT * FROM passed_tests where student_id = $student_id and paragraph_id = $paragraph_id";
    $result = mysqli_query($link, $query);
    if(mysqli_num_rows($result)==1)
    {
        return true;
    }
    else 
    {
        return false;
    }
}


function add_new_ticket_to_paragraph($question,$answer,$paragraph_id,$created_by)
{
    
    global $link;
    $course_id = get_courseID_by_paragraph($paragraph_id);
    $edited = date('c');

    $query = "INSERT INTO tickets (Question,Answer,CreatedBy,CourseId) VALUES ('$question','$answer','$created_by','$course_id')";
    mysqli_query($link, $query);

    $query = "SELECT * FROM tickets WHERE Question = '$question' and Answer = '$answer'";
    $result = mysqli_query($link, $query);
    $ticket = mysqli_fetch_assoc($result);
    $ticket_id = $ticket['id'];

    $query = "INSERT INTO paragraph_tickets (paragraph_id,ticket_id) VALUES ('$paragraph_id','$ticket_id')";
    mysqli_query($link, $query);
}
function get_ticket_by_question($question,$answer)
{
    global $link;
    $query = "SELECT * FROM tickets WHERE Question='$question' and Answer = '$answer'";
    $result = mysqli_query($link, $query);
    $ticket = mysqli_fetch_assoc($result);
    return $ticket;
}