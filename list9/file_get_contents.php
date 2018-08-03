<?php $info = file_get_contents("info.txt"); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>PHP!!</title>
</head>
<body>
<h1>PHPサークル交流サイト</h1>
<h2>お知らせ</h2>
<?php echo nl2br($info, false); ?>
</body>
</html>
