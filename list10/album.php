<?php
$images = array();
$num = 4;

if ($handle = opendir("album/")) {
    while ($entry = readdir($handle)) {
        if ($entry != "." && $entry != "..") {
            $images[] = $entry;
        }
    }
    closedir($handle);
}
?>
<html>
<head>
    <title>アルバム</title>
</head>
<body>
<h1>アルバム</h1>
<p>
    <a href="upload.php">アップロードする</a>
</p>
<?php
if (count($images) > 0) {
    $images = array_chunk($images, $num);
    $page = 0;
    if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
        $page = intval($_GET["page"]) - 1;
        if (!isset($images[$page])) {
            $page = 0;
        }
    }
    foreach ($images["$page"] as $img) {
        echo "<img src='album/" . $img . "'>";
    }
    echo "<p>";
    for ($i = 1; $i <= count($images); $i++) {
        echo "<a href='album.php?page=" . $i . "'>" . $i . "</a>&nbsp;";
    }
    echo "</p>";
} else {
    echo "<p>画像はまだありません。</p>";
}
?>
</body>
</html>