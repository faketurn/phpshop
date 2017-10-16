<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>スタッフ追加の確認 - 風農園</title>
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
<h1>スタッフ追加の確認</h1>

<?php
require_once("../common/escape.php");
$escaped = escape($_POST);

$staff_name = $escaped['name'];
$staff_pass = $escaped['pass'];
$staff_confirm_pass = $escaped['confirm_pass'];

if ($staff_name) {
    print("スタッフ名：{$staff_name}<br>");
} else {
    print("スタッフ名が入力されていません");
}

if (! $staff_pass) {
    print("パスワードが入力されていません");
}

if ($staff_pass !== $staff_confirm_pass) {
    print("パスワードが一致しません");
}

if ($staff_name and $staff_pass and $staff_pass === $staff_confirm_pass) {
    $staff_pass = md5($staff_pass);
    print ("
    <form method='post' action='staff_add_done.php'>
    <input type='hidden' name='name' value='{$staff_name}'>
    <input type='hidden' name='pass' value='{$staff_pass}'>
    <br>
    <input type='button' onclick='history.back()' value='戻る'>
    <input type='submit' value='確認OK'>
    </form>
    ");
    
}
?>
</body>
</html>