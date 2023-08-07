<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

        $pathinfo = pathinfo($_FILES['file']['name']);
        // $fname = $pathinfo['filename'];
        $fname = 'image';
        $extension = $pathinfo['extension'];

        $dest = 'uploads/' . $fname . '.' . $extension;
        $justname = $fname . '.' . $extension;
        $i = 1;
        while (file_exists($dest)){
            $dest = 'uploads/' . $fname . "_$i" .'.' . $extension;
            $justname = $fname . "_$i" .'.' . $extension;
            $i++;
        }

        // Write file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
            //
        } else {
            throw new Exception('Unable to move file');
        }
        echo $justname;

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>

<html>
    <head>
        <title>Upload files</title>
    </head>
    <body>
        <h1>Upload Image file</h1>
        <form method="post" enctype="multipart/form-data">
            <div>
                <label for="file">Image file</label>
                <input type="file" name="file" />
            </div>
            <button type="submit">Upload</button>
            
        </form>
        <img src="<?= $dest ?>" width="300" height="300">
    </body>
</html>