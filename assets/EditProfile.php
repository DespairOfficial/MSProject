<?php  
session_start();
require_once 'Header.php';
$user = $_SESSION['user'];
?>
<div>
    <form>
        <label>ФИО</label>    
        <input type="text" name ="full_name_edit" placeholder="Введите имя" value = "<?=$user['Name']?>">
        <label>Логин</label>
        <input type="text" name ="login_edit" placeholder="Введите логин" value = "<?=$user['Login']?>">
        <label>Изображение</label>
        <input name ="ImageEdit" type="file">
        <!--
        <label>Пароль</label>
        <input type="password" name ="password_edit" value = "">
        <label>Подтвердите пароль</label>
        <input type="password" value = "" name ="password_edit_conformation">-->
        <button type="submit" id="editprofile">Изменить</button>        
        <p class="editmsg none"></p>
    </form>
</div>



<?php require '../assets/Footer.php' ?>