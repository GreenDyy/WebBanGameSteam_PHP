<?php
$title = 'Add Game';
require 'class/Database.php';
require 'class/Game.php';
require 'class/Cart.php';
require 'class/Auth.php';
require 'inc/init.php';

$db = new Database();
$pdo = $db->getConnect();

$id_user = Auth::getIdUser($pdo, $_SESSION['log_detail']);

$infor = Auth::getOneUserByID($pdo, $id_user);


$name = '';
$sdt = '';
$address = '';

$nameErrors = '';
$sdtErrors = '';
$addressErrors = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['address']))
    {
        $addressErrors = 'Địa chỉ không được bỏ trống!';
    }
    if(!$addressErrors)
    {
        //khởi tạo
    $cart = new Cart();
    //có sẳn k cần nhập
    $id_user = Auth::getIdUser($pdo, $_SESSION['log_detail']);
    $code_cart = (rand(1000,9999));
    $cart_status = 0;

    $id_game = 0;
    $quantity = 0;
    $total_price = 0;

    $cart->id_user = $id_user;
    $cart->code_cart = $code_cart;
    $cart->cart_status = $cart_status;

    $cart->createCart($pdo);
    $code_cart = $cart->code_cart;

    for($i = 0; $i <= count($_SESSION['dsidgame']); $i++)
    {
        $cart->code_cart = $code_cart;
        //id_game
        $cart->id_game = $_SESSION['dsidgame'][$i];
        $game = Game::getOneByID($pdo, $cart->id_game);
        //quantity
        $cart->quantity = $_SESSION['dssoluong'][$i];
        //total_price
        $cart->total_price = $cart->quantity * $game->price;
        //address
        $cart->address = $_POST['address'];;
        $cart->createDetailCart($pdo);
    }
    header("Location: thanh-toan-success.php");
    exit;
    }
}
?>

<?php require 'inc/header.php'; ?>

<div class="background-image2">
    <div class="pt-4 min-vh-100">
        <h2 class="text-center" style="font-weight: bold;">THÔNG TIN ĐƠN HÀNG</h2>
        <div class="container w-50 mb-4">
            <form method="post" class="form-control">
                <div class="mb-3">
                    <label style="font-weight: bold;" for="name" class="form-label">Tên khách hàng</label>
                    <input class="form-control" id="name" name="name" value="<?= $infor->fullname ?>" disabled/> 
                    <span class="text-danger fw-bold"><?= $nameErrors ?></span>
                </div>
                <div class="mb-3">
                    <label style="font-weight: bold;" for="sdt" class="form-label">Số điện thoại</label>
                    <input class="form-control" id="sdt" name="sdt" value="<?= $infor->sdt ?>" disabled/> 
                    <span class="text-danger fw-bold"><?= $sdtErrors ?></span>
                </div>
                <div class="mb-3">
                    <label style="font-weight: bold;" for="address" class="form-label">Địa chỉ (*)</label>
                    <input class="form-control" id="address" name="address" value="<?= $address ?>" /> 
                    <span class="text-danger fw-bold"><?= $addressErrors ?></span>
                </div>
                <button type="submit" class="btn btn-success mt-2" name="action" value="Create">Hoàn tất đơn hàng</button>
            </form>
        </div>
    </div>
</div>

<?php require 'inc/footer.php'; ?>