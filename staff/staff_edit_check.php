<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>スタッフ修正の確認 - 風農園</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>スタッフ修正の確認</h1>

<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, "utf-8");
}

$staff_code = $_POST['code'];
$staff_name = $_POST['name'];
$staff_pass = $_POST['pass'];
$staff_confirm_pass = $_POST['confirm_pass'];

$staff_name = h($staff_name);
$staff_pass = h($staff_pass);
$staff_confirm_pass = h($staff_confirm_pass);

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
    <form method='post' action='staff_edit_done.php'>
    <input type='hidden' name='code' value='{$staff_code}'>
    <input type='hidden' name='name' value='{$staff_name}'>
    <input type='hidden' name='pass' value='{$staff_pass}'>
    <br>
    <input type='button' onclick='histroy.back()' value='戻る'>
    <input type='submit' value='確認OK'>
    </form>
    ");
    
}
?>
</body>
</html>