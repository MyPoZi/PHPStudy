<?php
include "login.php";

$name = $_POST["name"];
$title = $_POST["title"];
$body = $_POST["body"];
$pass = $_POST["pass"];
$token = $_POST["token"];

if ($name == "" || $body == "") {
    header("Location: bbs.php");
    exit();
}

if (!preg_match("/^[0-9]{4}$/", $pass)) {
    header("Location: bbs.php");
    exit();
}
//CSRF対策:トークンが正しいかどうか
if ($token != sha1(session_id())){
    header("Location: bbs.php");
    exit();
}
//名前をクッキーにセット
setcookie("name", $name, time() + 60 * 60 * 24);
//データベースに接続
$dsn = "mysql:host=localhost;dbname=php;charset=utf8";
$user = "phpuser";
$password = "password";

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    //プリペアドステートメントを作成
    $stmt = $db->prepare("INSERT INTO bbs(name, title, body, date, pass)VALUES(:name,:title,:body,now(),:pass)");

    // パラメータを割りあて
    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":title", $title, PDO::PARAM_STR);
    $stmt->bindParam(":body", $body, PDO::PARAM_STR);
    $stmt->bindParam(":pass", $pass, PDO::PARAM_STR);

    // クエリの実行
    $stmt->execute();

    // bbs.phpに戻る
    header("Location: bbs.php");
    exit();
} catch (PDOException $e) {
    die("エラー：" . $e->getMessage());
}
?>


