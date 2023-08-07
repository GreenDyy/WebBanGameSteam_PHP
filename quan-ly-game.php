<?php
$title = 'Home page';
require 'class/Database.php';
require 'class/Game.php';
require 'inc/init.php';

$db = new Database();
$pdo = $db->getConnect();

//page
$game_per_page = 6;  

$page = $_GET['page'] ?? 1; //mặc định là 1
$sobanghi = Game::demSoBanGhi($pdo)->sobanghi;
$minpage = 1;
$maxpage = ceil($sobanghi / $game_per_page);


$limit = $game_per_page;
$offset = ($page - 1) * $game_per_page;

$data = Game::getPage($pdo, $limit, $offset);

?>

<?php require 'inc/header.php'; ?>

<div class="mt-4 min-vh-100">

    <h2 class="text-center" style="font-weight: bold;">DANH SÁCH GAME</h2>
    <table class="table table-hover table-bordered mt-3 mb-3">
        <thead class="table-dark">
            <tr>
                <th >ID</th>
                <th>Game</th>
                <th>Mô tả</th>
                <th>Giá</th> 
                <th>Ảnh</th>
                <th style="width: 200px;">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $game): ?>
                <tr>
                    <?php foreach (get_object_vars($game) as $key => $value): ?>
                        <!-- id -->
                        <?php if ($key == 'id'): ?>
                            <td style="font-weight: bold;"><?= $value ?></td>
                        <!-- giá -->
                        <?php elseif ($key == 'price') : ?>
                            <td style="color:green"><?= number_format($value, 0, ',', '.') ?>đ</td>
                            <!-- tên -->
                        <?php elseif ($key == 'name'): ?>
                            <td><a style="color:black; text-decoration-line: none; font-weight: bold;" href="game.php?id=<?= $game->id ?>"><?= $value ?></a></td>
                            <!-- ảnh -->
                        <?php elseif ($key == 'image'): ?>
                            <td><img class="rounded img-fluid" src="image/<?=$value ?>"></td>
                        <!-- tên -->
                        <?php elseif ($key == 'description'): ?>
                            <td style="width: 1000px"><p><?=$game->description?></p></td>
                            
                        <?php else: ?>
                            <td><?= $value ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <td class="text-center">
                        <div class="mt-5">
                            <a class="btn btn-warning" href="edit-game.php?id=<?= $game->id ?>"><img src="icons/mod.png"/></a> 
                            <a id="btnxoa" onclick="return confirm('Bạn có muốn xoá game này không!');" class="btn btn-danger" href="delete-game.php?id=<?= $game->id ?>"><img src="icons/del.png"/></a> 
                        </div>       
                    </td>
                    
                </tr>
                    
            <?php endforeach; ?>
        </tbody>
    </table>

</div>


<!-- Phân trang--> 

<div class="mt-4 text-center" style="padding-bottom: 2px;">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                
                <li class="page-item"><a class="page-link <?=($page <= 1) ? 'disabled': ''; ?>" href = "quan-ly-game.php?page=<?= ($page >1) ? $page-1 : ''; ?>">Trang trước</a></li>

                <?php for($dem = 1; $dem <= $maxpage; $dem++) { ?>

                    <?php if ($page !== $dem) { ?>
                        <li class="page-item"><a class="page-link" href="quan-ly-game.php?page=<?=$dem; ?>"><?= $dem; ?></a></li>
                    <?php } else { ?>
                        <li class="page-item"><a class="page-link active"><?=$dem;?></a></li>
                    <?php } ?>
                <?php } ?>
                
                <li class="page-item"><a class="page-link <?=($page >= $maxpage) ? 'disabled' : ''; ?>" href = "quan-ly-game.php?page=<?= ($page < $maxpage) ? $page+1 : ''; ?>">Trang sau</a></li>
            </ul>
        </nav>
        <p class="text-white" style="font-weight: bold;">Trang <?=$page ?> trên <?=$maxpage?></p>
    </div>

<?php require 'inc/footer.php'; ?>
<sodsaotisadit