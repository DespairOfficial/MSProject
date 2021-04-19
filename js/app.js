//SignIn.php
//$-document.querySelector
//авторизация
$('.logbtn').click (function(e){
    e.preventDefault();

    $('input').removeClass('error');

    let login = $('input[name="Login"]').val() , password = $('input[name="Password"]').val();
    $.ajax({

        url: '../AuthAndReg/SignIn.php',
        type: 'POST',
        dataType: 'json',
        data: {
            Login: login,
            Password: password
        },
        success (data){

            
            if(data.status)
            {
                document.location.href = "../assets/SelfProfile.php";
            }
            else{
                if(data.type === 1)
                {
                    data.fields.forEach(function(field) {
                        $('input[name="'+field+'"]').addClass('error')
                    });
                }

                $('.msg').removeClass('none').text(data.message);
            }
            
        }
    })
})

//регистрация
let User_Image = false;
$('input[name="Image"]').change(function(e){
    User_Image = e.target.files[0];

})

$('.regbtn').click (function(e){
    e.preventDefault();

    $('input').removeClass('error');

    let login = $('input[name="Login"]').val(),
        password = $('input[name="Password"]').val(),
        full_name = $('input[name="Full_name"]').val(),
        password_conformation = $('input[name="Password_Conformation"]').val();

    let formData = new FormData();
    formData.append('Login', login);
    formData.append('Password', password);
    formData.append('Password_Conformation', password_conformation);
    formData.append('Full_name', full_name);
    formData.append('Image', User_Image);

    $.ajax({

        url: '../AuthAndReg/SignUp.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData, 
        success (data){

            
            if(data.status)
            {
                document.location.href = "../AuthAndReg/Auth.php";
            }
            else{
                if(data.type === 1)
                {
                    data.fields.forEach(function(field) {
                        $('input[name="'+field+'"]').addClass('error')
                    });
                }

                $('.msg').removeClass('none').text(data.message);
            }
            
        }
    })
})

//Проверка на кодовое слово
$('#code_word_submit').click (function(e){ //кнопка подтверждения кодового слова
    e.preventDefault();
    $('input[name="code_word_input"]').removeClass('error');
    let code_word = $('input[name="code_word_input"]').val()
    $.ajax({
        url: '../Course/CheckCodeWord.php',
        type: 'POST',
        dataType: 'json',
        data: {
            code_word_input: code_word,
            id_course: id_course
        },
        success (data){

            
            if(data.status)
            {
                document.location.href = "../Course/InCourse.php?id=" +id_course;
                window.alert(data.message);
            }
            else{
                $('.msg-code-word').text(data.message);
                $('input[name="code_word_input"]').addClass('error');
            } 
        }
    })

})



//Перенос билетов из общего пула в пул курса


function AddToParagraph()
{   
    let markedElements = document.querySelectorAll(".MarkedToParagraph")
    let result = []
    markedElements.forEach(function(markedElem)
    {
        let idstr = markedElem.id
        let ticket_id = idstr.replace('row','')
        result.push(ticket_id)
    })
    $.ajax({
        url: '../Course/AddToParagraph.php',
        type: 'POST',
        dataType: 'json',
        data: { 
            result,
            paragraph_id
        },
        success(data){
            console.log(13)
            $('#rand_num_tickets').attr('max',data.rnd_tick_num)
            markedElements.forEach(function(markedElem)
            {
                markedElem.classList.remove("MarkedToParagraph")
                $('#paragraphtickets').append(markedElem)
                let idstr = markedElem.id
                let ticket_id = idstr.replace('row','')
                markedElem.setAttribute('onclick',`mark_this_to_remove(${ticket_id})`)
            })
        }
    })
}
function mark_this_to_paragraph(id)
{
    document.querySelector(`#row${id}`).classList.toggle("MarkedToParagraph")
}
function mark_this_to_remove(id)
{
    document.querySelector(`#row${id}`).classList.toggle("MarkedToRemove")
}
function RemoveFromParagraph()
{
    let markedElements = document.querySelectorAll(".MarkedToRemove")
    let result = []
    markedElements.forEach(function(markedElem)
    {
        let idstr = markedElem.id
        let ticket_id = idstr.replace('row','')
        result.push(ticket_id)
    })
    $.ajax({
        url: '../Course/RemoveFromParagraph.php',
        type: 'POST',
        dataType: 'json',
        data: { 
            result,
            paragraph_id
        },
        success(data){
            markedElements.forEach(function(markedElem)
            {
                markedElem.classList.remove("MarkedToRemove")
                $('#coursetickets').append(markedElem);
                let idstr = markedElem.id
                let ticket_id = idstr.replace('row','')
                markedElem.setAttribute('onclick',`mark_this_to_paragraph(${ticket_id})`)
            })
        }
    })
}

$('#endtestbutton').click (function(e){
    e.preventDefault();
    
    let get_answers = document.querySelectorAll(".inputanswer")
    let result = []
    let ids = []
    get_answers.forEach(function(answer)
    {   
        answer.classList.remove("errorvoid");
        let id = answer.id
        let vals = answer.value
        result.push(vals)
        ids.push(id)
        
    })

    $.ajax({
        url: 'ProcessResults.php',
        type: 'POST',
        dataType: 'json',
        data: {result, ids},
        success (data){
            if(data.status==0)
            {
                data.error_fields.forEach(function(field){
                    $('#'+field).addClass('errorvoid')});
            }
            else{ 
                if(data.test_res==0)
                {
                    $('#testresult').text('Поздравляем, вы завалили тест!'); 
                }
                else
                {
                    $('#testresult').text('Ваш результат: ' + data.test_res+'%'); 
                }

                $('#endtestbutton').prop('disabled',true)
            }
            
        }
    })
})
$('#addnewticket').click (function(e){
    e.preventDefault();
    let question = $('input[name="Question"]').val()
    let answer = $('input[name="Answer"]').val()
    $('input[name="Question"]').removeClass('error')
    $('input[name="Answer"]').removeClass('error')
    $.ajax({
        url: '../CreateTicket.php',
        type: 'POST',
        dataType: 'json',
        data: {
            question: question,
            answer: answer,
            paragraph:  paragraph_id

        },
        success (data){
            if(data.status)
            {
                $('#rand_num_tickets').attr('max',data.rnd_tick_num)
                $('#addedmessage').text(data.message)
                let div = document.createElement('div');
                ticket_id = data.ticket_id
                let div_content = ` <label name = 'Question' >Вопрос: ${question}</label>
                                    <label name= 'Answer' >Ответ: ${answer}</label>
                                    <label name='id' >Номер билета: ${ticket_id}</label>`
                div.innerHTML = div_content
                div.setAttribute('class',"row")
                div.setAttribute('id',`row${ticket_id}`)
                div.setAttribute('onclick',`mark_this_to_remove(${ticket_id})`)
                $('#paragraphtickets').append(div)
            }
            else{
                $('#addedmessage').text(data.message)
                data.error_fields.forEach(function(field){
                    $('input[name='+field+']').addClass('error')});
                
            }
            

        }
    })
})

$('#addparagraph').click (function(e){
    e.preventDefault();
    document.location.href = "CreateParagraphPage.php?id="+course_id; 
})



//изменение профиля
let User_Image_Edited = false;
$('input[name="ImageEdit"]').change(function(e){
    User_Image_Edited = e.target.files[0];

})


$('#editprofile').click (function(e){
    e.preventDefault();

    $('input').removeClass('error');

    let login = $('input[name="login_edit"]').val(),
        password = $('input[name="password_edit"]').val(),
        full_name = $('input[name="full_name_edit"]').val(),
        password_conformation = $('input[name="password_edit_conformation"]').val();

    let formData = new FormData();
    formData.append('Login', login);
    formData.append('Password', password);
    formData.append('Password_Conformation', password_conformation);
    formData.append('Full_name', full_name);
    formData.append('Image', User_Image_Edited);

    $.ajax({

        url: 'ConfirmChanges.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData, 
        success (data){

            
            if(data.status)
            {
                document.location.href = "SelfProfile.php";
            }
            else{
                if(data.type === 1)
                {
                    data.fields.forEach(function(field) {
                        $('input[name="'+field+'"]').addClass('error')
                    });
                }

                $('.editmsg').removeClass('none').text(data.message);
            }
            
        }
    })
})

$('#confirm_par_edit').click (function(e){
    e.preventDefault();
    let name = $('#paragraph_name').val(), 
    description = $('textarea[name="Description"]').val()
    $.ajax({

        url: 'ConfirmParagraphEdit.php',
        type: 'POST',
        dataType: 'json',
        data: {
            name: name,
            description: description,
            paragraph_id: paragraph_id   
             }, 
        success (data){
            $('#changed_label').text(data.message);
            if(!data.status)
            {
                data.fields.forEach(function(field){
                    $('#'+field).addClass('error')
                })
            }
        }
    })
})

$('.dropdown').click(function () {
    $(this).attr('tabindex', 1).focus();
    $(this).toggleClass('active');
    $(this).find('.dropdown-menu').slideToggle(300);
});
$('.dropdown').focusout(function () {
    $(this).removeClass('active');
    $(this).find('.dropdown-menu').slideUp(300);
});
$('.dropdown .dropdown-menu li').click(function () {
    $(this).parents('.dropdown').find('span').text($(this).text());
    $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
});
/*End Dropdown Menu*/


$('#edit_user_role').click (function(e){ //кнопка подтверждения кодового слова
    e.preventDefault();
    let role = $('#UserRole').val()
    $.ajax({
        url: '../EditUserRole.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: user_id,
            role: role
        },
        success (data){

        }
    })

})

$('#rand_num_tickets').change(function (e){
   e.preventDefault();
    $.ajax({
        url: 'GetRandTicketNum.php',
        type: 'POST',
        dataType: 'json',
        data: {
            paragraph_id: paragraph_id
        },
        success (data){
            $('label[for="rand_num_tickets"]').text(data.tickets_in_course)
            //$('#rand_num_tickets').attr('max',data.tickets_in_course)
        }
    })
})