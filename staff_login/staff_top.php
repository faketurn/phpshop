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
<h1>ショップ管理トップメニュー</h1>

<p><a href="../staff/staff_list.php">スタッフ管理</a></p>
<p><a href="../product/product_list.php">商品管理</a></p>
<p><a href="staff_logout.php">ログアウト</a></p>

</body>
</html>