<?php
$msg = null;
if (isset($_FILES["image"]) && is_uploaded_file($_FILES["image"]["tmp_name"])) {
    $old_name = $_FILES["image"]["tmp_name"];
//    $new_name = $_FILES["image"]["name"];
    $new_name = date("YmdHis");
    $new_name .= mt_rand();
    switch (exif_imagetype($old_name)){
        case IMAGETYPE_JPEG:
            $new_name.=".jpg";
            break;
        case IMAGETYPE_GIF:
            $new_name .= ".gif";
            break;
        case IMAGETYPE_PNG:
            $new_name .= ".png";
            break;
        default:
            header("Location: upload.php");
            exit();
    }
    if (move_uploaded_file($old_name, "album/" . $new_name)) {
        $msg = "アップロードしました";
    } else {
        $msg = "アップロードできませんでした。";
    }
}
?>
<html>
<head>
    <title>画像アップロード</title>
</head>
<body>
<h1>画像アップロード</h1>
<?php
if ($msg) {
    echo "<p>" . $msg . "</p>";
}
?>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit" value="アップロード">
</form>
</body>
</html>
