<?php
$msg = null;
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
<img style="border-radius: 50%;" src="images/new_image">
<form action="ImageResize.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="アップロード">
</form>
</body>
</html>
