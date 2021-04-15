<?php 
session_start();
require '../assets/Header.php';
?>
<div class="row" style="margin: 10px;">
    <div class="col-12">
        <form  method="post" action="CreateParagraph.php">
            <label >Название темы</label>
            <input required name="Name" style="width: 100%; height: 40px;" type="text">
            <br>
            <label>Описание темы</label>
            <br>
            <textarea required name="Description" rows="5" style ="resize: both; width: 100%;"  ></textarea>
            <button>Добавить</button>
        </form>
    </div>
</div>
<?require '../assets/Footer.php';?>