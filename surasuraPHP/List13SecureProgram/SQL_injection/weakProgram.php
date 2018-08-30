<?php
//SQLインジェクションの攻撃用文字列
//$namePost = "鈴木' OR '1' = '1";
//' OR 1 = 1; -- ';
$namePost = $_POST['name'];
$passPost = $_POST['password'];

//データベース接続
$dsn = 'mysql:host=localhost;dbname=php;charset=utf8';
$user = 'phpuser';
$password = 'password';

try {
    $db = new PDO($dsn, $user, $password);

    $records = $db->query("SELECT * FROM users WHERE name='$namePost'");

    foreach ($records as $row) {
        echo '<p>ID:' . $row['id'] . '</p>';
        echo '<p>name:' . $row['name'] . '</p>';
        echo '<p>password:' . $row['password'] . '</p>';
        echo '<hr />';
    }
} catch (PDOException $e) {
    die('エラー:' . $e->getMessage());
}
?>
<html>
<head>
    <title>PHP</title>
</head>
<body>
<h1>IDとPASSWORD</h1>
<p>ID：<?php echo $namePost; ?></p>
<p>PASSWORD：<?php echo $passPost; ?></p>
</body>
</html>

