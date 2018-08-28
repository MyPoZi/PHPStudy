<?php
class Sample{
    public $test = "すぃ";
    public function __construct($name = "Sample"){
        echo "コンストラクタ:" . $name;
        echo $this->test . "<br>";

    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "デストラクタ:";
    }
}
$sample = new Sample();
unset($sample);
echo "プログラム終了時とunset関数使ったバージョン";
?>