<?php
session_start();

if (isset($_SESSION["id"])) {
    //セッションにユーザーIDがある=ログインしている
    //トップページに遷移する
//    header("Location: index.php"); //指定すると毎回index.phpに戻される
//    exit();
} else if (isset($_POST["name"]) && isset($_POST["password"])) {
    //ログインしていないがユーザ名とパスワードが送信されたとき
    // データベースに接続
    $dsn = "mysql:host=localhost;dbname=php;charset=utf8";
    $user = "phpuser";
    $password = "password";

    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        //プリペアドステートメント作成
        $stmt = $db->prepare("SELECT * FROM users WHERE name=:name AND password=:pass");

        //パラメータ割り当て
        $stmt->bindParam(":name", $_POST["name"], PDO::PARAM_STR);
        $stmt->bindParam(":pass", sha1($_POST["password"]), PDO::PARAM_STR);

        $stmt->execute();
        /* SQLインジェクション対策はデータ内のクォーテーションのエスケープ処理を行って、対応する閉じクォーテーションだと認識させないようにする。専用の関数もある*/
        /*PDOの持つプリペアドステートメント機能を使い、bindParamメソッドでデータを渡してあげることで、PDOが自動的に適切なエスケープ処理を行ってくれる。SQLインジェクション対策*/
        if ($row = $stmt->fetch()) {
            //ユーザが存在していたので、セッションにユーザIDをセット
            $_SESSION["id"] = $row["id"];
            //セッションID再作成、セッションハイジャック対策
            session_regenerate_id(true);
            header("Location: index.php");
            exit();
        } else {
            //1レコードも取得できなかったとき
            //ユーザ名・パスワードが間違っている可能性あり
            //もう一度ログインフォームを表示
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        die("エラー:" . $e->getMessage());
    }
} else {
    //ログインしていない場合はログインフォームを表示する
    ?>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <title>PHPサークル掲示板</title>
    </head>
    <body>
    <h1>PHPサークル掲示板</h1>
    <h2>ログイン</h2>
    <form action="login.php" method="post">
        <p>ユーザ名:<input type="text" name="name"></p>
        <p>パスワード:<input type="password" name="password"></p>
        <p><input type="submit" value="ログイン"></p>
    </form>
    </body>
    </html>
<?php
    exit(); //exit()がなければ、ログインページ以外も表示されてしまう
}
?>