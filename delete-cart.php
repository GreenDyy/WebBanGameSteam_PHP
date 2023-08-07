<?php
require 'class/Database.php';
require 'class/Game.php';
require 'class/Auth.php';
require 'class/Cart.php';

if (!isset($_GET["id_cart"])) {
    die("Cần cung cấp id cart!");
}

$id_cart = $_GET["id_cart"];
$db = new Database();
$pdo = $db->getConnect();  
$cart = new Cart;
$cart->deleteCart($pdo, $id_cart);
?>

<script language="javascript">
    alert("Xoá thành công!");
</script>
<?php
    header("Location: quan-ly-don-hang.php");
    exit;
?>
        

