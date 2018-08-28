<?php
include "vendor.php5";

echo vending_machine(120, "オレンジジュース");

$price = 90;
$juice_name = "アップルジュース";
echo vending_machine($price, $juice_name);
echo strlen("aiueo");
echo "<br>";
echo mb_strlen("aiueo");
echo "<br>";
echo strlen("あいうえお");
echo "<br>";
echo mb_strlen("あいうえお");
?>
