<?php 
require '../assets/Header.php';
$id_Course = trim($_GET["id"]);
$id_Student = $_SESSION['user']['id']; 
$code_word = get_code_word_by_course($id_Course);
?>
<script>
    var id_course = <?=$id_Course?>
</script>
<div class="container-fluid">
    <div class="row">
        <form>
            <input  name = "code_word_input">
            <button id="code_word_submit">Кнопка</button>
        </form>
     </div>
</div>

<label class="msg-code-word"></label>

<?php require '../assets/Footer.php' ?>