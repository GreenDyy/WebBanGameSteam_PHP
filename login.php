<?php
$title = 'Login page';
require 'inc/init.php';
require 'class/Auth.php';
require 'class/Database.php';
require 'class/Game.php';

$db = new Database();
$pdo = $db->getConnect();

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION['log_role'] = Auth::getRole($pdo, $username);
    $error = Auth::login($pdo, $username, $password);
}
?>

<?php require 'inc/header.php'; ?>

<div class="background-image2 d-flex min-vh-100">
    
        <div class="card mx-auto py-5 mt-5 mb-5" style="width: 400px; height: 600px;">
            <h1 class="text-center mb-5" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Login</h1>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <i class="fa fa-user icon"></i>
                        <label for="username" class="form-label small" style="font-weight: bold;">Username</label>
                        <input type="text" class="form-control rounded-pill" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <i class="fa fa-lock icon"></i>
                        <label for="password" class="form-label small" style="font-weight: bold;">Password</label>
                        <input type="password" class="form-control rounded-pill" id="password" name="password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4 rounded-pill" style="border: none; width: 365px; font-weight: bold; background-color: #00b300;"  name="login">LOGIN</button>
                    </div>
                </form>
            </div>
            <!-- nếu lỗi thì thông báo -->
            <?php if ($error): ?>
                <div class="">
                    <p class="text-danger text-center" style="margin-bottom: 80px;"><?= $error ?></p>
                </div>
            <?php endif; ?>
            <p class="text-center"><a href="signup.php">Create your Account</a></p>
            
        </div>
    
</div>


<?php require 'inc/footer.php'; ?>