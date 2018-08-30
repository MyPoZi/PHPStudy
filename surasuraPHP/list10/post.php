<?php

$name = $_POST["name"];

$gender = $_POST["gender"];
if ($gender == "man") {
    $gender = "男性";
} else if ($gender == "woman") {
    $gender = "女性";
} else {
    $gender = "不正な値です";
}
$tmp_star = intval($_POST["star"]);
$star = "";
if ($tmp_star < 1 || $tmp_star > 5) {
    $star = "不正な値です";
} else {
    for ($i = 0; $i < $tmp_star; $i++) {
        $star .= "★";
    }
    for (; $i < 5; $i++) {
        $star .= "☆";
    }
}
$other = $_POST["other"];
?>
<html>
<head>
    <title>PHPアンケート結果</title>
</head>
<body>
<h1>ResultEnquete</h1>
<p>お名前：<?php echo $name; ?></p>
<p>性別：<?php echo $gender; ?></p>
<p>評価：<?php echo $star; ?></p>
<p>ご意見：<?php echo nl2br($other, false); ?></p>
</body>
</html>
