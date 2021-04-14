<?php 
require '../assets/Header.php';

$user_id = trim($_GET["id"]);
$user = get_user_by_id($user_id);
?>
    <form action="">
    <img src="<?= $user['Image'] ?>" width ="100" alt="">
    <h2><?= $user['Name'] ?></h2>
    <h3>Это страница пользователя <?=$user['Name']?></h3>
    <h2>Роль пользователя: <?= $user['Role'] ?></h2>
    <a href="../AuthAndReg/Logout.php" style="color: red;">Выход</a>
    </form>
<?php require '../assets/Footer.php' ?>