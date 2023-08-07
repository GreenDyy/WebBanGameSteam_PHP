<?php
$title = 'Home page';
require 'class/Database.php';
require 'class/Game.php';
require 'class/Auth.php';
require 'inc/init.php';

$db = new Database();
$pdo = $db->getConnect();
$data = Auth::getAllUser($pdo);
?>

<?php require 'inc/header.php'; ?>

<div class="background-image2">
    <div class="pt-4 min-vh-100">

        <h2 class="text-center" style="font-weight: bold;">DANH SÁCH USER</h2>
        <table class="table table-hover table-bordered mt-3 mb-3">
            <thead class="table-dark">
                <tr><th >No.</th>
                    <th >ID</th>
                    <th>Uername</th>
                    <th>Password</th>
                    <th>Role</th> 
                    <th>Tên đầy đủ</th>
                    <th>Số điện thoại</th>
                    <th style="width: 200px;">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($data as $user): ?>
                    <tr style="font-weight: bold;">
                        <td><?=$i ?></td>
                        <?php foreach (get_object_vars($user) as $key => $value): ?>
                            <!-- id -->
                            <?php if ($key == 'id'): ?>
                                <td><?= $value ?></td> 
                            <?php else: ?>
                                <td><?= $value ?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <td class="text-center">
                            <a class="btn btn-warning" href="edit-user.php?id=<?= $user->id ?>"><img src="icons/mod.png"/></a> 
                            <a id="btnxoa" onclick="return confirm('Bạn có muốn xoá user này không!');" class="btn btn-danger " href="delete-user.php?id=<?= $user->id ?>"><img src="icons/del.png"/></a>          
                        </td>
                        <?$i++ ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require 'inc/footer.php'; ?>