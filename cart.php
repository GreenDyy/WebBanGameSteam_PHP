<?php
$title = 'Cart page';
require 'class/Database.php';
require 'class/Game.php';
require 'class/Auth.php';
require 'inc/init.php';

$db = new Database();
$pdo = $db->getConnect();

$data = Game::getAll($pdo);

$dsidgame = array();
$dssoluong = array();
$dsdongia = array();

$_SESSION['cac'] = 'cac';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['cart'][$_POST['gameid']]['qty'] = $_POST['qty'];
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'empty') {
        $_SESSION['cart'] = [];
    }
    if ($action == 'detele') {
        if (isset($_GET['gameid'])) {
            $gameid = $_GET['gameid'];
            unset($_SESSION['cart'][$gameid]);
        }
    }
}
?>

<?php require 'inc/header.php'; ?>

<div class="container min-vh-100">
    <table class="table my-3">
        <a href="cart.php?action=empty" class="btn btn-danger mt-2">Xoá giỏ hàng</a>
        <thead>
            <tr class="text-center">
                <th>No.</th>
                <th>Game</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($_SESSION['cart'])):
                $i = 1; $total = 0;
                foreach ($_SESSION['cart'] as $cart) : 
                    $game = GAME::getOneByID($pdo, $cart['gameid']); 
            ?>

                    <tr class="text-center">
                        <form method="post">
                        <td><?= $i ?></td>
                        <td><?= $game->name ?></td>
                        <td><?= number_format($game->price, 0, ',', '.') ?> VNĐ</td>
                        <td>
                            <input type="number" value="<?= $cart['qty'] ?>" name="qty" min="1" style="width: 50px;" />
                            <input type="hidden" name="gameid" value="<?= $cart['gameid'] ?>" />
                        </td>
                        <td>
                            <input type="submit" name="update" value="Cập nhật" class="btn btn-warning" style="width: 100px"/> 
                            <a href="cart.php?action=detele&gameid=<?= $cart['gameid'] ?>" class="btn btn-danger" style="width: 100px">Xoá</a>
                        </td>

                        <?php  
                            array_push($dsidgame, $game->id);
                            array_push($dsdongia, $game->price);
                            array_push($dssoluong, $cart['qty']);
                        ?>

                        </form>
                    </tr>
        
            <?php 
                $i++; $total += $game->price * $cart['qty'];
                endforeach;    

                $_SESSION['dsidgame'] = $dsidgame; //tạo ra dùng cho thanh-toan.php
                $_SESSION['dssdongia'] = $dsdongia;   
                $_SESSION['dssoluong'] = $dssoluong;   

            endif; ?>

            <td colspan="5" class="text-center">
                <!-- giỏ hàng trống -->
                <?php if($total == 0): ?>
                    <div class="mb-3">
                        <img src="icons/emptycart.png"/></br>
                        <h3>Oops!, không có sản phẩm nào trong giỏ hàng!</h3>
                        <a href="index.php" class="btn btn-danger rounded-pill" style="width: 270px;"><img src="icons/back.png"/> Tiếp tục mua hàng</a>
                    </div>    
                <?php else: ?>
                    <h4>Tổng tiền: <?= number_format($total, 0, ',', '.') ?> VNĐ</h4>
                    <a class="btn btn-danger mb-2" href="thanh-toan.php">Thanh toán</a>
                <?php endif; ?>
            </td>
        </tbody>
    </table>
    
</div>

<?php require 'inc/footer.php'; ?>