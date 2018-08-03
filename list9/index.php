<?php
$fp = fopen("info.txt", "r");
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>PHPサークル交流サイト</title>
</head>
<body>
<h1>PHPサークル交流サイト</h1>
<h2>お知らせ</h2>
<?php
if ($fp) {
    $title = fgets($fp);
    if ($title) {
        echo "<a href='file_get_contents.php'>" . $title . "</a>";
    } else {
        echo "お知らせはありません";
    }
    fclose($fp);
} else {
    echo "お知らせはありません";
}
?>
</body>
</html>
