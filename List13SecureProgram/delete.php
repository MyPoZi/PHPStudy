<?php
include "login.php";
$id = intval($_POST["id"]);
$pass = $_POST["pass"];
$token = $_POST["token"];

if ($id == "" || $pass == ""){
    header("Location: bbs.php");
    exit();
}

//CSRF対策:トークンが正しいかどうか
if ($token != sha1(session_id())){
    header("location: bbs.php");
    exit();
}

$dsn = "mysql:host=localhost;dbname=php;charset=utf8";
$user = "phpuser";
$password = "password";

try{
    $db = new PDO($dsn,$user,$password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    // プリペアドステートメント作成
    $stmt = $db->prepare("DELETE FROM bbs WHERE id=:id AND pass = :pass");
    // パラメータ割り当て
    $stmt->bindParam(":id",$id,PDO::PARAM_INT);
    $stmt->bindParam(":pass",$pass,PDO::PARAM_STR);
    // クエリの実行
    $stmt->execute();
}catch (PDOException $e){
    echo "エラー：" . $e->getMessage();
}
header("Location: bbs.php");
exit();
?>