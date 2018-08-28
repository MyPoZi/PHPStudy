<?php
$fp = fopen("test.txt", "w");
if ($fp) {
    fwrite($fp, "書き込みテスト1行目\n");
    fwrite($fp, "書き込みテスト2行目\n");
    fclose($fp);
    echo "書き込み終了";
} else {
    "書き込めていません";
}
?>
