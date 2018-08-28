<?php
include 'login.php';
$num = 3;
$dsn = "mysql:host=localhost;dbname=php;charset=utf8";
$user = "phpuser";
$password = "password";

$page = 0;
if (isset($_GET["page"]) && $_GET["page"] > 0) {
    $page = intval($_GET["page"]) - 1;
}

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //プリペアドステートメント作成
    $stmt = $db->prepare("SELECT * FROM bbs ORDER BY date DESC LIMIT :page, :num");
    //パラメータ割り当て
    $page = $page * $num;
    $stmt->bindParam(":page", $page, PDO::PARAM_STR);
    $stmt->bindParam(":num", $num, PDO::PARAM_INT);
    $stmt->execute();
} catch (PDOException $e) {
    echo "エラー:" . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>掲示板</title>
</head>
<body>
<h1>掲示板</h1>
<form action="writeCokkie.php" method="post">
    <p>名前<input type="text" name="name" value="<?php echo isset($_COOKIE['name']) ? $_COOKIE['name'] : "" ?>"></p>
    <p>タイトル:<input type="text" name="title"></p>
    <textarea name="body"></textarea>
    <p>削除パスワード(数字4文字):><input type="text" name="pass"></p>
    <p><input type="submit" value="書き込む"></p>
    <input type="hidden" name="token" value="<?php echo sha1(session_id()); ?>"> <!--CSRF対策-->
</form>
<hr/>
<?php
while ($row = $stmt->fetch()):
    $title = $row["title"] ? $row["title"] : "(無題)";
    ?>
    <p>名前：<?php echo nl2br(htmlspecialchars($row["name"],ENT_QUOTES,"UTF-8").false); ?></p>
    <p>タイトル：<?php echo nl2br(htmlspecialchars($title,ENT_QUOTES,"UTF-8").false); ?></p>
    <?php echo nl2br(htmlspecialchars($row["body"],ENT_QUOTES,"UTF-8").false); ?>
    <p><?php echo $row["date"] ?></p>

    <!--コメント削除機能-->
    <form action="delete.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!--valueを""で囲まないとXSSが可能になる-->
        削除パスワード:<input type="password" name="pass">
        <input type="submit" value="削除">
    <input type="hidden" name="token" value="<?php echo sha1(session_id()); ?>"> <!--CSRF対策-->
</form>
    <hr/>
<?php
endwhile;
try {
    //プリペアドステートメント作成
    $stmt = $db->prepare("SELECT COUNT(*) FROM bbs");
    $stmt->execute();
} catch (PDOException $e) {
    echo "エラー:" . $e->getMessage();
}
//コメント件数を取得、最初のカラム
$comments = $stmt->fetchColumn();
//ページ数を計算
$max_page = ceil($comments / $num);
echo "<p>";
for ($i = 1; $i <= $max_page; $i++) {
    echo "<a href='bbs.php?page=" . $i . "'>" . $i . "</a>&nbsp;";
}
echo "</p>";
?>
</body>
</html>