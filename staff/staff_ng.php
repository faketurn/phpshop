<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>風農園</title>
<link rel="stylesheet" href="../css/style.css">
<?php

session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) === false) {
    print("<p>ログインされていません。</p>");
    print("<a href='../staff_login/staff_login.html'>ログイン画面へ</a>");
    exit();
} else {
    print("<p>{$_SESSION['staff_name']}さん ログイン中</p>");
}

?>
</head>
<body>
<h1>エラー</h1>

<P>スタッフが選択されていません。</p>

<p><a href="staff_list.php">一覧へ</a></p>
</body>
</html>