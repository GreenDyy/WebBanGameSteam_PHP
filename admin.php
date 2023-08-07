<?php
$title = 'Admin';

require 'class/Database.php';
require 'class/Game.php';
require 'class/Auth.php';
require 'inc/init.php';


$db = new Database();
$pdo = $db->getConnect();

?>
<?php require 'inc/header.php'; ?>

<div class="background-image2">
    <div class="pt-5 container min-vh-100 text-center">
        <a class="btn btn-success rounded-pill m-3" style="font-size: 16pt; font-weight: bold; width: 320px;" href="quan-ly-user.php"><img src="icons/edit-user-48.png"> QUẢN LÝ USER</a>
        <a class="btn btn-success rounded-pill m-3" style="font-size: 16pt; font-weight: bold; width: 320px;" href="quan-ly-game.php"><img src="icons/product-48.png"> QUẢN LÝ SẢN PHẨM</a>
        <a class="btn btn-success rounded-pill m-3" style="font-size: 16pt; font-weight: bold; width: 320px;" href="quan-ly-don-hang.php"><img src="icons/purchase-order-48.png"> QUẢN LÝ ĐƠN HÀNG</a>
    </div>
</div>

<?php require 'inc/footer.php'; ?>