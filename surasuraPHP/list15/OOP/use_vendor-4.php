<?php
include "vending_machine-4.php";
$test = new VendingMachine();
$vendor = new CupnoodleVendor();
echo $vendor->buy(180) . "<br>";
echo "製造元:" . $vendor->showMaker() . "<br>";
//echo "製造元:" . $test->$vendor; privateのためエラー
?>