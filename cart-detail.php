<?php
$title = 'cart detail page';
if (! isset($_GET["code_cart"])) {
    die("Cần cung cấp mã đơn hàng!");
}

$code_cart = $_GET["code_cart"];

require 'class/Database.php';
require 'class/Game.php';
require 'class/Cart.php';
require 'inc/init.php';

$db = new Database();
$pdo = $db->getConnect();
$data = Cart::getDetailCart($pdo, $code_cart);
$total = 0;

if (!$data) {
    die("code_cart không hợp lệ!");
}
?>

<?php require 'inc/header.php'; ?>

<div class="background-image2">
    <div class="" style="padding-left: 10px;">
    
    <h2 class="pt-4" style="font-weight: bold;">THÔNG TIN KHÁCH HÀNG</h2>
        <?php $infor = Cart::getThongTinKhach($pdo, $code_cart); ?>
        <!-- <p style="background-color: #b3ffcc; color: #006622; padding-left: 10px; height: 40px;" >Thông tin khách hàng</p> -->
        <p style="font-weight: bold;">Tên khách hàng: <?=$infor->fullname ?></p>
        <p style="font-weight: bold;">Số điện thoại: <?=$infor->sdt ?></p>
        <p style="font-weight: bold;">Địa chỉ: <?=$infor->address ?></p>
    </div>
    <p style="background-color: green; width: auto; height: 3px;"></p>
        

    <div class="pt-4 min-vh-100">

        <h2 class="text-center" style="font-weight: bold;">DANH SÁCH ĐƠN HÀNG</h2>
        <table class="table table-hover table-bordered mt-3 mb-3">
            <thead class="table-dark">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên game</th>
                    <th>Số lượng</th> 
                    <th>Đơn giá</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $cart): ?>
                    <tr>
                        <td><?=$cart->code_cart ?></td>
                        <td><?=$cart->name ?></td>
                        <td><?=$cart->quantity ?></td>
                        <td><?= number_format($cart->price, 0, ',', '.') ?>đ</td>
                        <td><?= number_format($cart->total_price, 0, ',', '.') ?>đ</td>
                        <?php $total = $total + $cart->total_price?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="card" style="padding-left: 10px; padding-top: 10px; margin-left: 10px; margin-right: 10px;">
            <p class="text-danger" style="font-weight: bold; font-size: 20px;">Thành tiền: <?=number_format($total, 0, ',', '.') ?>đ</p>
        </div>
    </div>
</div>

<?php require 'inc/footer.php'; ?>