<?php
$title = 'Edit Game';
require 'class/Database.php';
require 'class/Game.php';

if (! isset($_GET["id"])) {
    die("Cần cung cấp id game !!!");
}

$id = $_GET["id"];
$db = new Database();
$pdo = $db->getConnect();
$game= Game::getOneByID($pdo, $id);

$name = '';
$desc = '';
$price = '';
$image = '';
$nameImageUpload = '';

$nameErrors = '';
$descErrors = '';
$priceErrors = '';
$uploadErrors = '';

$dsgenre_hientai = array(); //số lượng genre của game tại thời điểm ấn submit

if ($_SERVER["REQUEST_METHOD"] == "POST") {
// ----------------------------------------up ảnh--
if ($_POST['action'] == 'UpImage') {
    try {
        if (empty($_FILES['file'])) {
            throw new Exception('Invalid upload');
        }

        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uploaded.');
            default:
                throw new Exception('An error occured');
        }

        if ($_FILES['file']['size'] > 1000000) {
            throw new Exception('File too large.');
        }

        $mime_types = ['image/gif', 'image/jpeg', 'image/png', 'image/jpg'];
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($file_info, $_FILES['file']['tmp_name']);
        if (!in_array($mime_type, $mime_types)) {
            throw new Exception('Invalid file type.');
        }
        
        //tạo tên ảnh
        $pathinfo = pathinfo($_FILES['file']['name']);
        $fname = $pathinfo['filename'];
        $extension = $pathinfo['extension'];
        $dest = 'image/' . $fname . '.' . $extension;
        $image = $fname . '.' . $extension;
        $nameImageUpload = $image;

        //nếu file tồn tại rồi thì
        while (file_exists($dest)){
            $uploadErrors = 'File đã tồn tại!';
            break;
        }
        // Write file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
            //  
        } else {
            throw new Exception('Unable to move file');
        }

    } 
    catch (Exception $e) {
        echo $e->getMessage();
    }
    // ----------------------------------------up ảnh--
    }
    else if ($_POST['action'] == 'update') {
        //check error!
        if (empty($_POST['name'])) {
            $nameErrors = 'Bạn chưa nhập tên game!';
        }

        if (empty($_POST['desc'])) {
            $descErrors = 'Bạn chưa nhập mô tả!';
        }

        if (empty($_POST['price'])) {
            $priceErrors = 'Bạn chưa nhập giá!';
        } 
        elseif ($_POST['price'] % 1000 != 0) {
            $priceErrors = 'Giá phải chia hết cho 1000!';
        }
        if (empty($_POST['image']) == "Chọn ảnh") {
            $imageErrors = 'Bạn chưa chọn ảnh!';
        }
        
        $game = new Game();
        // Update game
        if (!$nameErrors && !$descErrors && !$priceErrors) {
            $name = $_POST['name'];
            $desc = $_POST['desc'];
            $price = $_POST['price'];
            $image = $_POST['image'];

            $game->name = $name;
            $game->description = $desc;
            $game->price = $price;
            $game->image = $image;
            //hàm sửa
            $game->updateGame($pdo, $id);
        }
        //sửa genre (mấy th dc check thì tạo)
        if(isset($_POST['chkgenre']))
        {  
            $chkgenre = $_POST['chkgenre'];
            foreach($chkgenre as $key=>$value)
            {
                $game->createGameGenre($pdo, $id, $value);
                array_push($dsgenre_hientai, $value);
            }
        }
        //Sửa genre (xoá đó xoá genre nào k dc check)---
        $fullgenre = array(1, 2, 3 , 4, 5, 6, 7, 8, 9, 10, 11);
        $genreChuaCheck = array_diff($fullgenre, $dsgenre_hientai);
        foreach($genreChuaCheck as $genreid)
        {
            $game->deleteGenreFromGame($pdo, $id, $genreid);
        }
        if (!$nameErrors && !$descErrors && !$priceErrors) {
            header("Location: game.php?id={$id}");
            exit;
        }
    }
}

//load thư mục ảnh
$dir_path = "image/";
$option = "";
if(is_dir($dir_path))
{
    $files = opendir($dir_path);
    {
        if($files)
        {
            while(($file_name = readdir($files)) !== FALSE)
            {
                if($file_name != '.' && $file_name != '..')
                {
                    $option = $option."<option>$file_name</option>";
                }
            }
        }
    }
}
?>

<?php require 'inc/header.php'; ?>

<div class="background-image2 pb-3 pt-3 min-vh-100">
    <h1 class="text-center" style="font-weight: bold;">CẬP NHẬT GAME</h1>
    <div class="container w-50 mb-4">
        <div class="container">
            <h2>Tải ảnh lên<span class="text-danger"> (Nếu bạn cần ảnh mới!)</span></h2>
            <form method="post" enctype="multipart/form-data" class="form-control">
                <div>
                    <input type="file" name="file" />
                </div>
                <button type="submit" name="action" value="UpImage" class="btn btn-success mt-2">Upload</button>
                <?php if($uploadErrors): ?>
                <p class="text-danger" style="margin-left: 10px; font-weight: bold;"><?=$uploadErrors?></p>    
                <?endif;?>

                <?php if($image != ''): ?>
                    <img class="rounded img-fluid mt-3 mb-4" style="display: block; margin-left: auto; margin-right:auto;" src="image/<?= $nameImageUpload ?>"> 
                    <p class="text-center"><?= $nameImageUpload ?></p>
                <?php endif;?>
            </form>
        </div>

        <div class="contaier">
            <h2>Cập nhật game</h2>
            <form method="post" class="form-control">
                <div class="mb-3">
                    <label for="name" class="form-label">Name (*)</label>
                    <input class="form-control" id="name" name="name" value="<?= $game->name ?>" /> 
                    <span class="text-danger fw-bold"><?= $nameErrors ?></span>
                
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description (*)</label>
                    <textarea class="form-control" id="desc" name="desc" rows="4"><?= $game->description ?></textarea> 
                    <span class="text-danger fw-bold"><?= $descErrors ?></span>

                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price (*)</label>
                    <input class="form-control" id="price" name="price" type="number" value="<?= $game->price ?>" /> 
                    <span class="text-danger fw-bold"><?= $priceErrors ?></span>

                </div>
                <div class="mb-3">
                        <label for="image" class="form-label">Image (*)</label>
                        <div class="select">

                            <select class="form-select" id="image" name = "image">
                                <option selected disabled value="<?=$game->image?>"><?=$game->image?></option>
                                <option value="<?=$option?>"><?=$option?></option>   
                            </select>
                        </div>

                </div>
                <div class="mb-3">
                    <?php if($game->image != null): ?>
                    <img style="display: block; margin-left: auto; margin-right:auto;" class="rounded img-fluid" src="image/<?= $game->image ?>">
                    <?php endif; ?>
                </div>
                
                <p>Thể loại:</p>
                <div class="card mb-3">
                    <?php
                        $listgenre = array(); //dùng để xem loại game nào dc check
                        // lấy tất cả thể loại của 1 game này
                        $dstheloai = Game::getTheLoaiGame($pdo, $id);          
                        foreach($dstheloai as $theloai)
                        {
                            $genregame = $theloai->GenreId;
                            array_push($listgenre, $genregame);
                        }
                    ?>
                        <ul class="nav">             
                            <li>
                                <label for="hanhdong">1: Hành Động
                                    <input type="checkbox" id="hanhdong" name="chkgenre[]" value="1" class="btn btn-warning" style="width: 80%"<?=(in_array("1", $listgenre)) ? 'checked':'';?>/>
                                </label>

                                <label for="phieuluu">2: Phiêu Lưu
                                    <input type="checkbox" id="phieuluu" name="chkgenre[]" value="2" class="btn btn-warning" style="width: 80%"<?=(in_array("2", $listgenre)) ? 'checked':'';?>/>
                                </label>
                                <label for="doikhang">3: Đối Kháng
                                    <input type="checkbox" id="doikhang" name="chkgenre[]" value="3" class="btn btn-warning" style="width: 80%"<?=(in_array("3", $listgenre)) ? 'checked':'';?>/>
                                </label>
                                <label for="bansung">4: Bắn Súng
                                    <input type="checkbox" id="bansung" name="chkgenre[]" value="4" class="btn btn-warning" style="width: 80%"<?=(in_array("4", $listgenre)) ? 'checked':'';?>/>
                                </label>
                                <label for="chienthuat">5: Chiến Thuật
                                    <input type="checkbox" id="chienthuat" name="chkgenre[]" value="5" class="btn btn-warning" style="width: 80%"<?=(in_array("5", $listgenre)) ? 'checked':'';?>/>
                                </label>
                                <label for="thethao">6: Thể Thao
                                    <input type="checkbox" id="thethao" name="chkgenre[]" value="6" class="btn btn-warning" style="width: 80%"<?=(in_array("6", $listgenre)) ? 'checked':'';?>/>
                                </label>
                                <label for="thegioimo">7: Thế Giới Mở
                                    <input type="checkbox" id="thegioimo" name="chkgenre[]" value="7" class="btn btn-warning" style="width: 80%"<?=(in_array("7", $listgenre)) ? 'checked':'';?>/>
                                </label>
                                <label for="sinhton">8: Sinh Tồn
                                    <input type="checkbox" id="sinhton" name="chkgenre[]" value="8" class="btn btn-warning" style="width: 80%"<?=(in_array("8", $listgenre)) ? 'checked':'';?>/>
                                </label>
                                <label for="kinhdi">9: Kinh Dị 
                                    <input type="checkbox" id="kinhdi" name="chkgenre[]" value="9" class="btn btn-warning" style="width: 80%"<?=(in_array("9", $listgenre)) ? 'checked':'';?>/>
                                </label>
                                <label for="nhapvai">10: Nhập Vai
                                    <input type="checkbox" id="nhapvai" name="chkgenre[]" value="10" class="btn btn-warning" style="width: 80%"<?=(in_array("10", $listgenre)) ? 'checked':'';?>/>
                                </label>
                                <label for="duaxe">11: Đua Xe
                                    <input type="checkbox" id="duaxe" name="chkgenre[]" value="11" class="btn btn-warning" style="width: 80%"<?=(in_array("11", $listgenre)) ? 'checked':'';?>/>
                                </label>
                            </li>
                        </ul>
                    </div>
                <div class="text-center mb-3">
                    <button class="btn btn-success" style="width: 150px;" type="submit" name="action" value="update">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'inc/footer.php'; ?>