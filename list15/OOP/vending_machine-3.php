<?php
class VendingMachine{
    public $maker = "翔泳電気";

    public function buy($money){
        $message = "";
        if ($money >= 150) {
            $message .= "<p>お買い上げありがとうございます!</p>";
            $message .= $this->lucky();
        }else{
            $message .= "購入金額が不足しています";
        }
        return $message;
    }

    private function lucky(){
        if (rand(1,10) == 1){
            return "もう一本サービス";
        }else{
            return "ハズレ";
        }
    }

    public function showMaker(){
        return $this->maker;
    }

}
?>
