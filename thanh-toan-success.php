<?php
$title = 'Thanh toán';
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
        <?php $_SESSION['cart'] = []; ?>
        <h5 class="text-success"><img src="icons/success.png">Thanh toán thành công!</h5>
        <h6>Chúng tôi sẽ sớm liên lạc với bạn</h6>
        <h6>Cảm ơn bạn đã tin tưởng</h6>
        <a href="index.php" class="btn btn-danger rounded-pill" style="font-weight: bold; width: 270px;"><img src="icons/back.png"/> Tiếp tục mua hàng</a>
    </div>
</div>

<?php require 'inc/footer.php' ?>
