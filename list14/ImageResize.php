<?php
$new_width = 250; //サムネイルの幅

//元画像の縦横サイズの取得
list($width,$height) = getimagesize($_FILES["file"]["tmp_name"]);
$rate = $new_width / $width; //比率
$new_height = $rate * $height; //サムネイルの高さ
/*1000,600 = 5:3
250 / 1000 = 0.25
    600 * 0.25 = 150
        250:150 = 5:3
*/

//計算したサイズでキャンバスを作成
$canvas = imagecreatetruecolor($new_width,$new_height);

//アップロードした画像の拡張子によって新ファイル名と画像の読み込み方を変える
switch (exif_imagetype($_FILES["file"]["tmp_name"])) {
    //JPEG
    case IMAGETYPE_JPEG:
        $image = imagecreatefromjpeg($_FILES["file"]["tmp_name"]);
        imagecopyresampled($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagejpeg($canvas, "images/new_image");//拡張子を消したがhtmlを直接変更すれば、どんな拡張しでも表示できると思う
        break;

    //GIF
    case IMAGETYPE_GIF:
        $image = imagecreatefromgif($_FILES["file"]["tmp_name"]);
        imagecopyresampled($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagegif($canvas, "images/new_image");//拡張子を消したがhtmlを直接変更すれば、どんな拡張しでも表示できると思う
        break;

    //PNG
    case IMAGETYPE_PNG:
        $image = imagecreatefrompng($_FILES["file"]["tmp_name"]);
        imagecopyresampled($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagepng($canvas, "images/new_image");//拡張子を消したがhtmlを直接変更すれば、どんな拡張しでも表示できると思う
        break;
    default:
        exit();
}
imagedestroy($image);
imagedestroy($canvas);

header("Location: Upload.php")
?>
