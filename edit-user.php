<?php
$title = 'Edit User';
require 'class/Database.php';
require 'class/Game.php';
require 'class/Auth.php';

if (! isset($_GET["id"])) {
    die("Cần cung cấp id user!");
}

$id = $_GET["id"];
$db = new Database();
$pdo = $db->getConnect();
$user= Auth::getOneUserByID($pdo, $id);


$username = '';
$password = '';
$role = '';
$fullname = "";
$sdt = "";

$usernameErrors = '';
$passwordErrors = '';
$fullnameErrors = "";
$sdtErrors = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //check error
	if (empty($_POST['username'])) {
		$usernameErrors = "Bạn chưa nhập tài khoản!";
	} else {
		$username = $_POST['username'];
		if (!preg_match("/^[a-zA-z]*$/",$username)) {
			$usernameErrors = "Tài khoản chỉ được phép nhập các chữ cái!";
		}
	}
	if (empty($_POST['password'])) {
		$passwordErrors = "Bạn chưa nhập mật khẩu";
	} else {
		$password = $_POST['password'];
		$length = strlen($password);
		if ($length <  5) {
			$passwordErrors = "Mật khẩu phải nhiều hơn 5 kí tự!";
		}
	}
	if (empty($_POST['fullname'])) {
		$fullnameErrors = "Bạn chưa nhập tên!";
	}
	if (empty($_POST['sdt'])) {
		$sdtErrors = "Bạn chưa nhập số điện thoại!";
	}

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $fullname = $_POST['fullname'];
    $sdt = $_POST['sdt'];
    // Nếu ko có lỗi gì
    if (!$usernameErrors && !$passwordErrors && !$fullnameErrors && !$sdtErrors) {
        $user = new Auth();

        if(isset($_POST['role']))
        {  
            $role = $_POST['role'];
        }
        else
        {  
            $role = "user";
        }
        $user->username = $username;
        $user->password = $password;
        $user->role = $role;
        $user->fullname = $fullname;
        $user->sdt = $sdt;

        //hàm sửa ở đây nha
        $user->updateUser($pdo, $id);
        header("Location: quan-ly-user.php");
        exit;
    } 
}
?>

<?php require 'inc/header.php'; ?>

<div class="background-image2">
    <div class="pt-4 min-vh-100">
    <h2 style="text-align: center; font-weight: bold;">CẬP NHẬT USER</h2>
    <form method="post" class="form-control w-50 m-auto mb-2">
        <div class="mb-3">
            <label for="name" class="form-label" style="font-weight: bold;">Username (*)</label>
            <input class="form-control" id="username" name="username" value="<?= $user->username ?>" /> 
            <span class="text-danger fw-bold"><?= $usernameErrors ?></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label" style="font-weight: bold;">Password (*)</label>
            <input class="form-control" id="password" name="password" value="<?= $user->password ?>" /> 
            <span class="text-danger fw-bold"><?= $passwordErrors ?></span>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label" style="font-weight: bold;">Role (*)</label>
            <div class="card mb-3">
                <ul class="nav">
                    <li>
                        <?php $roleuser = Auth::getRole($pdo, $user->username); ?>
                        <label for="admin">admin
                            <!-- nếu role = admin thì check vào -->
                            <input type="radio" name="role" value="admin" class="btn btn-warning" style="width: 80%" <?=($roleuser == 'admin') ? 'checked' : '';?>/>
                        </label>
                        <label for="user">user
                            <input type="radio" name="role" value="user" class="btn btn-warning" style="width: 80%" <?=($roleuser == 'user') ? 'checked' : '';?>/>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mb-3">
            <label for="fullname" class="form-label" style="font-weight: bold;">Họ và Tên (*)</label>
            <input class="form-control" id="fullname" name="fullname" value="<?= $user->fullname ?>" /> 
            <span class="text-danger fw-bold"><?= $fullnameErrors ?></span>
        </div>
        <div class="mb-3">
            <label for="sdt" class="form-label" style="font-weight: bold;">Số điện thoại (*)</label>
            <input class="form-control" id="sdt" name="sdt" value="<?= $user->sdt ?>" /> 
            <span class="text-danger fw-bold"><?= $sdtErrors ?></span>
        </div>
        <div class="text-center mb-3">
            <button class="btn btn-success" style="width: 150px;" type="submit" name="action" value="Create">Cập nhật</button>
        </div>
    </form> 
</div>

<?php require 'inc/footer.php'; ?>