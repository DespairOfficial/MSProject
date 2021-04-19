
<?php 
require 'assets/Header.php';
session_start();
?>

<div class="pseudobody">
	<strong>Здравствуйте, <?= $_SESSION['user']['Name'] ?></strong>
    <div class = "container">
        <div class="content">
            <ul class="bmenu">
            <?if(($_SESSION['user']['Role']=='Admin')):?>
                <li><a href="ListOfUsers.php">Пользователи</a></li>
                <li><a href="ListOfTickets.php">Список билетов</a></li>
            <?endif;?>
                <li><a href="Course/CoursesPage.php">Курсы</a></li>
                <li><a href="AuthAndReg/Register.php">Регистрация</a></li>
            </ul>
        </div>
    </div>

    <!--<button class="exitbtn" >Выход</button>
    <script>
        $(".exitbtn").click(function(){
        var snd = new Audio("sounds/Fuck you.mp3")
        snd.play()

        })
    </script>-->
</div>   
<?php require 'assets/Footer.php' ?>

	

