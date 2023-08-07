
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script> -->
    <!-- để boostrap online với coi danh mục dc, mà off thì mới up len web dc :< -->
    
    
    <link rel="icon" href="http://www.yoursite.com/favicon.ico?v=2" />
    

    <title><?=$title?></title>
</head>

<body>
<!-- background -->
<style>
    *{
        margin: 0;
        padding: 0;
    }
    .background-image {
        background-image: url("image/wall4.jpg");
        background-size: auto;
    }
    .background-image2 {
        background-image: url("image/gray.jpg");
        background-size: auto;
    }

    .zoom {
        transition: all 0.3s;
    }
    .zoom:hover {
        transform: scale(1.03);
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }
    input::placeholder {
    font-weight: bold;
    opacity: 0.7;
    font-size: 10pt;   
}
a {
    color: black;
    transition: all 0.5s;
}
    a:hover {
    color: green;
    transform: scale(1.03);
}
</style>

<!-- background -->
<?php

if(isset($_GET['btnsearch']))
{
    $keyword = $_GET['keyword'];
    header("Location: search-game.php?keyword=$keyword");
    exit;
}

if(isset($_GET['btnfilter']))
{
    $sort = $_GET['sort'];
    header("Location: sort-game.php?sort=$sort");
    exit;
}

?>

    <nav class="navbar navbar-expand-sm " style="background-color: #008040; height: 110px;">
        <div class="container" style="font-weight: bold;">
            <a class="navbar-brand text-white" href="index.php"><img src="icons/logo.png" width="50px" height="50px"> Green<span style="color: lightseagreen">Store</span></a>
            <div class="navbar-collapse">
                <ul class="navbar-nav small">
                    <!-- Phần này của admin -->
                    <?php 
                        // nếu có session dang nhap thi set $role = log_role
                        $role = isset($_SESSION['log_detail']) ? ($_SESSION['log_role']) :'';
                        if ($role == "admin"): 
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="add-game.php"><img src="icons/add.png"/> Thêm game mới</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="admin.php"><img src="icons/admin.png"/> Admin</a>
                    </li>
                    <?php endif; ?>
                     <!-- ---- -->
                    
                    <!-- nếu chưa đăng nhập -->
                    <?php if (!isset($_SESSION['log_detail'])): ?>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="signup.php"><img src="icons/sigup.png"/> Đăng ký</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="login.php"><img src="icons/user.png"/> Đăng nhập</a>
                    </li>
                    <!-- nếu đã đăng nhập -->
                    <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"><img src="icons/sigup.png"/> Hi, <?=$_SESSION['log_detail']?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php"><img src="icons/logout.png"/> Đăng xuất</a>
                    </li>
                    <?php endif; ?>
                    
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link text-white" type="button" id="dropdownMenuButton" 
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="icons/dropdown.png"> Danh mục game</a>
                            <div class="dropdown-menu" aria-labelledby="">

                                <?php $dstheloai = Game::getAllGenreName($pdo); ?>
                                <?php foreach ($dstheloai as $theloai): ?>
                                    <a class="dropdown-item" href="game-theo-the-loai.php?genreid=<?=$theloai->id ?>"><?= $theloai->name?></a>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </li>
                    
                    <li class="nav-item mx-2 card rounded-pill">
                        <form method="get" class="container">
                            <input style="margin-top: 11px; border: 0px;" name="keyword" type="text" placeholder="Nhập tên game...">
                            <button class="btn mb-1" style="margin-left: -12px;" name= "btnsearch" type="submit"><img src="icons/search.png"/></button>
                        </form>
                    </li>

                </ul>
                <?php if (isset($_SESSION['log_detail'])): ?>
                <div>
                    <a class="btn btn-dark rounded-pill" href="cart.php"><img src="icons/cart.png"/> Giỏ hàng
                        <?php if (isset($_SESSION['cart'])) {
                            echo count($_SESSION['cart']);
                        } ?>
                    </a>
                </div>  
                <?php endif; ?>  
            </div>
        </div>
    </nav>
   
        
    

  
    
    