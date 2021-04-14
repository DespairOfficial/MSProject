<?php 
require '../assets/Header.php';
?>
    <form action="">
    <img src="<?= $_SESSION['user']['Image'] ?>" width ="100" alt="">
    <h2><?= $_SESSION['user']['Name'] ?></h2>
    <h2>Роль пользователя: <?= $_SESSION['user']['Role'] ?></h2>
    <a href="/AuthAndReg/Logout.php" style="color: red;">Выход</a>
    </form>
<?php require '../assets/Footer.php' ?>