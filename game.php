<?php
$title = 'game page';
if (! isset($_GET["id"])) {
    die("Cần cung cấp id sản phẩm !!!");
}

$id = $_GET["id"];

require 'class/Database.php';
require 'class/Game.php';
require 'inc/init.php';

$db = new Database();
$pdo = $db->getConnect();
$game = Game::getOneByID($pdo, $id);

if (!$game) {
    die("id không hợp lệ!");
}
?>

<?php require 'inc/header.php'; ?>
<div class="background-image pt-5 pb-5">
    <div class="container card" >
        <table class="table table-hover table-bordered mt-3 mb-3" style="margin-bottom: 0%;">
            <tr>
                <th colspan="2" class="table-dark text-center"><h2 style="font-weight: bold;">Chi tiết sẩn phẩm:</h2></th>
            </tr>
            <tr>
                <th class="table-dark" style="width: 10%">Mã SP</th>
                <th><?= $game->id ?></th>
            </tr>
            <tr>
                <th class="table-dark">Tên SP</th>
                <th style="font-weight: bold;"><?= $game->name ?></th>
            </tr>
            <tr>
                <th class="table-dark">Mô tả</th>
                <th><?= $game->description ?></th>
            </tr>
            <tr>
                <th class="table-dark">Thể loại</th>
                <?php $dstheloai = Game::getTheLoaiGame($pdo, $game->id); ?>
                <?php $string = '';?>
                <!-- xử lý hiển thị genre và dấu phẩy cuối -->
                <?php 
                    $counter = 0;
                    foreach ($dstheloai as $theloai): ?>
                        <?php 
                            if($counter == count($dstheloai)-1)
                                $string = $string.$theloai->Genre;
                            else 
                                $string = $string.$theloai->Genre.', ';?>
                <?php 
                    $counter = $counter + 1;
                    endforeach; 
                ?>

                <th style="font-weight: bold;"><?=rtrim($string,",");?></th>
            </tr>
            <tr>
                <th class="table-dark">Giá</th>
                <th style="color:red"><?= number_format($game->price, 0, ',', '.') ?>đ</th>
            </tr>
            <tr>
                <th class="table-dark">Hình</th>
                <th colspan="2">
                    <?php if($game->image != null): ?>
                    <img class="rounded img-fluid" src="image/<?= $game->image ?>">
                    <?php endif; ?>
                </th>
                
            </tr>
            <!-- đăng nhập mới hiện chức năng -->
            <?php if (isset($_SESSION['log_detail'])): ?>

            <tr>
                <th class="table-dark">Chức năng</th>
                <th>               
                    <?php if ($role == "admin"):?>
                    <a class="btn btn-warning" href="edit-game.php?id=<?= $game->id ?>">Sửa</a> 
                    <a id="btnxoa" onclick="return confirm('Bạn có muốn xoá không!');" class="btn btn-danger" href="delete-game.php?id=<?= $game->id ?>">Xoá</a> 
                    <?php endif ?>
                    <a class="btn btn-success" href="index.php?action=addcart&gameid=<?=$game->id ?>">Thêm vào giỏ hàng</a>           
                </th>
            </tr>
            <?php endif; ?> 
        </table>
    </div>
</div>

<?php require 'inc/footer.php'; ?>