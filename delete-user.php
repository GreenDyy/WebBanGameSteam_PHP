<?php
require 'class/Database.php';
require 'class/Game.php';
require 'class/Auth.php';

if (!isset($_GET["id"])) {
    die("Cần cung cấp id user!");
}

$id = $_GET["id"];
$db = new Database();
$pdo = $db->getConnect();

$game = new Auth();
$game->deleteUser($pdo, $id);     
?>

<script language="javascript">
    alert("Xoá thành công!");
</script>
<?php
    header("Location: quan-ly-user.php");
    exit;
?>
        

