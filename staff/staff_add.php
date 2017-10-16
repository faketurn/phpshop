<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>スタッフ追加 - 風農園</title>
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
<h1>スタッフ追加</h1>

<form method="post" action="staff_add_check.php">
<p>スタッフ名を入力してください</p>
<p><input type="text" name="name"></p>

<p>パスワードを入力してください</p>
<p><input type="password" name="pass"></p>

<p>もう一度パスワードを入力してください</p>
<p><input type="password" name="confirm_pass"></p>

<p><input type="submit" value="送信"></p>
<p><input type="button" onclick="history.back()" value="戻る"></p>
</form>
</body>
</html>