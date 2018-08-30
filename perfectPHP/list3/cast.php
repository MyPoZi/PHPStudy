<?php

class Judge{
    function judge100($num){
        if ($num === 100){
            $result =  "num is 100\n";
            echo $result;
            return;
        }else{
            $result = "num is not 100\n";
            echo $result;
            return;
        }
    }
}

echo 15.0,PHP_EOL;
printf('%.1f',15.0);
echo "\n";
if (!isset($argv[1])){
    exit();
}
$num = $argv[1];
$Judge = new Judge();
$Judge->judge100($num);
$num = intval($num);
$Judge->judge100($num);





