<?php
require 'class/Database.php';
require 'class/Game.php';

if (!isset($_GET["id"])) {
    die("Cần cung cấp id game!");
}

$id = $_GET["id"];
$db = new Database();
$pdo = $db->getConnect();

$game = new Game();
$game->deletegame($pdo, $id);     
?>

<script language="javascript">
    alert("Xoá thành công!");
</script>
<?php
    header("Location: quan-ly-game.php");
    exit;
?>
        

