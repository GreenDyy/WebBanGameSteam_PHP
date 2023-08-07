<?php
$title = 'Quản lý đơn hàng';
require 'class/Database.php';
require 'class/Game.php';
require 'class/Cart.php';
require 'class/Auth.php';
require 'inc/init.php';

$db = new Database();
$pdo = $db->getConnect();
$data = Cart::getAllCart($pdo);
?>

<?php require 'inc/header.php'; ?>

<div class="background-image2">
    <div class="pt-4 min-vh-100">

        <h2 class="text-center" style="font-weight: bold;">DANH SÁCH ĐƠN HÀNG</h2>
        <table class="table table-hover table-bordered mt-3 mb-3">
            <thead class="table-dark">
                <tr>
                    <th >No.</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th> 
                    <th>Trạng thái</th>
                    <th style="width: 200px;">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($data as $cart): ?>
                    <tr>
                        <td><?=$i ?></td>
                        <td><?=$cart->code_cart ?></td>
                        <td><?=$cart->fullname ?></td>
                        <td><?=$cart->sdt ?></td>
                        <td><a href="edit-cart.php?id_cart=<?=$cart->id_cart ?>"><?= ($cart->cart_status == "0") ? $cart->cart_status="Chưa xử lý" : '';?> <?=($cart->cart_status == "1") ? $cart->cart_status="Đã xử lý" : ''; ?></a></td>
                        <td class="text-center">
                            <a class="btn btn-success" href="cart-detail.php?code_cart=<?=$cart->code_cart ?>"><img src="icons/detail.png"/></a> 
                            <a id="btnxoa" onclick="return confirm('Bạn có muốn xoá đơn hàng này không!');" class="btn btn-danger" href="delete-cart.php?id_cart=<?=$cart->id_cart ?>"><img src="icons/del.png"/></a>          
                        </td>
                        <? $i++ ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require 'inc/footer.php'; ?>