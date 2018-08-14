<?php
include "vending_machine-3.php";
$vendor = new VendingMachine();
echo $vendor->buy(180) . "<br>";

echo $vendor->showMaker() . "<br>";
echo $vendor->maker . "<br>";
?>
