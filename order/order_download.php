<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ショップ管理トップメニュー - 風農園</title>
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
    
<?php
require_once("../common/escape.php");
?>
<h1>ショップ管理トップメニュー</h1>

<p>ダウンロードしたい注文日を選んでください</p>

<form method='post' action='order_download_done.php'>
<?php pulldown_year(); ?>
年

<?php pulldown_month(); ?>
月

<?php pulldown_day(); ?>
日

<p><input type="submit" value="ダウンロード画面へ"></p>
</form>

</body>
</html>