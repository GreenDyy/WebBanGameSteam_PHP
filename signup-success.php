<?php
$title = 'signup success';
require 'inc/init.php';
require 'class/Auth.php';
require 'class/Database.php';
require 'class/Game.php';

$db = new Database();
$pdo = $db->getConnect();
?>

<?php require 'inc/header.php'; ?>

<div class="container text-center p-5 mt-5 mb-5" style="width: 500px; height: 440px;">
    <div class="mt-5 pt-5">
        <h5 class="text-success"><img src="icons/success.png">Đăng ký tài khoản thành công!</h5>
        <a href="login.php" class="btn btn-danger rounded-pill" style="font-weight: bold; width: 325px;">ĐĂNG NHẬP NGAY</a>
    </div>
</div>

<?php require 'inc/footer.php' ?>


