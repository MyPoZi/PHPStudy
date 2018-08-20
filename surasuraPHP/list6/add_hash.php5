<pre>
<?php
$result = array(
    "japanese" => 80,
    "math" => 75,
    "science" => 90,
    "history" => 85,
    "english" => 80
);
var_dump($result);

$result["math"] = 85;
var_dump($result);

$result["music"] = 90;
var_dump($result);
?>
</pre>