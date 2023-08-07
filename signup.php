<?php
$title = 'Sign up page';
require 'inc/init.php';
require 'class/Auth.php';
require 'class/Database.php';
require 'class/Game.php';

$db = new Database();
$pdo = $db->getConnect();

$usernameErrors = "";
$passwordErrors = "";
$repasswordErrors = "";
$fullnameErrors = "";
$sdtErrors = "";

$username = "";
$password = "";
$repassword = "";
$fullname = "";
$sdt = "";

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

	if (empty($_POST['repassword'])) {
		$repasswordErrors = "Bạn chưa nhập lại mật khẩu!";
	} else {
		$repassword = $_POST['repassword'];
		if ($password != $repassword) {
			$repasswordErrors = "Mật khẩu không khớp, vui lòng kiểm tra lại!";
		}
	}
	if (empty($_POST['fullname'])) {
		$fullnameErrors = "Bạn chưa nhập tên!";
	}
	if (empty($_POST['sdt'])) {
		$sdtErrors = "Bạn chưa nhập số điện thoại!";
	}

	//create username ne
	$account = new Auth;
    $username = $_POST['username'];
    $password = $_POST['password'];
	$fullname = $_POST['fullname'];
    $sdt = $_POST['sdt'];
	if (!$usernameErrors && !$passwordErrors && !$repasswordErrors && !$fullnameErrors && !$sdtErrors && $password == $repassword) 
	{
		$dem = $account->checkExistUser($pdo, $username)->dem;
		if($dem <= 0)
		{
			$account->username = $username;
			$account->password = $password;
			$account->fullname = $fullname;
			$account->sdt = $sdt;
			$account->createUser($pdo);
			header("Location: signup-success.php");
		}
		else
		{
			$usernameErrors = "Tài khoản đã tồn tại!";
			$username = "";
			$password = "";
			$repassword = "";
			$sdt = "";
			$fullname = "";
		}
	}
	else
	{
		$username = "";
		$password = "";
		$repassword = "";
		$sdt = "";
		$fullname = "";
	}
}
?>


<?php
require 'inc/header.php'
?>
<div class="background-image2 d-flex min-vh-100">
	<div class="card mx-auto py-5 mt-5 mb-5" style="width: 400px; height: 600px;">

		<h1 class="text-center mb-5" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Sign Up</h1>
		<div class="card-body">
			<form method="post">
				<div class="mb-3">
					<i class="fa fa-user icon"></i>
                    <label for="username" class="form-label small" style="font-weight: bold;">Username</label>
                    <input type="text" class="form-control rounded-pill" id="username" name="username" value="<?=$username?>" required>
					<p style="color:red"><?=$usernameErrors?></p>
				</div>
				<div class="mb-3">
					<i class="fa fa-lock icon"></i>
                    <label for="password" class="form-label small" style="font-weight: bold;">Password</label>
                    <input type="password" class="form-control rounded-pill" id="password" name="password" value="<?=$password?>" required>
					<p style="color:red"><?=$passwordErrors?></p>
				</div>
				<div class="mb-3">
					<i class="fa fa-lock icon"></i>
					<label for="repassword" class="form-label small" style="font-weight: bold;">Confirm Password</label>
					<input type="password" class="form-control rounded-pill" id="repassword" name="repassword" value="<?=$repassword?>" required>
					<p style="color:red"><?=$repasswordErrors?></p>
				</div>
				<div class="mb-3">
					<i class="fa fa-address-card-o icon"></i>
					<label for="sdt" class="form-label small" style="font-weight: bold;">Họ và tên</label>
					<input type="text" class="form-control rounded-pill" id="fullname" name="fullname" value="<?=$fullname?>" required>
					<p style="color:red"><?=$fullnameErrors?></p>
				</div>
				<div class="mb-3">
					<i class="fa fa-mobile icon"></i>
					<label for="sdt" class="form-label small" style="font-weight: bold;">Số điện thoại</label>
					<input type="text" class="form-control rounded-pill" id="sdt" name="sdt" value="<?=$sdt?>" required>
					<p style="color:red"><?=$sdtErrors?></p>
				</div>
				<div class="text-center">
                        <button type="submit" class="btn btn-success mt-4 rounded-pill" style="border: none; width: 365px; font-weight: bold; background-color: #00b300;"  name="login">SIGN UP</button>
                </div>
			</form>
		</div>	
		<p class="text-center" >Already a account? <a style="font-weight: bold;" href="login.php">Log in</a></p>
	</div>
</div>

<?php require 'inc/footer.php'; ?>