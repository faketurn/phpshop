<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>商品追加の確認 - 風農園</title>
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
<h1>商品追加の確認</h1>

<?php
require_once("../common/escape.php");
$escaped = escape($_POST);

$product_name = $escaped['name'];
$product_price = $escaped['price'];
$product_image = $_FILES['image'];
// echo "<pre>";
// var_dump($product_image);
// echo "</pre>";


if ($product_name) {
    print("商品名：{$product_name}<br>");
} else {
    print("商品名が入力されていません<br>");
}

if (preg_match('/^[0-9]+$/', $product_price)) {
    print("価格：{$product_price}円<br>");
} else {
    print("価格をきちんと入力してください<br>");
}

if ($product_image['size'] > 0 and $product_image['size'] > 1000000) {
    print("画像が大きすぎます");
} elseif ($product_image['size'] > 0) {
    // アップロードするタイミング、ここでいいのだろうか？add_done時でよくね？
    move_uploaded_file($product_image['tmp_name'], 'image/' . $product_image['name']);
    print("<p><img src='image/" . $product_image['name'] . "'></p>");
}

if ($product_name and preg_match('/^[0-9]+$/', $product_price) and $product_image['size'] <= 1000000) {
    print ("
    <p>上記の商品を追加します</p>
    <form method='post' action='product_add_done.php'>
    <input type='hidden' name='name' value='{$product_name}'>
    <input type='hidden' name='price' value='{$product_price}'>
    <input type='hidden' name='image_name' value='" . $product_image['name'] . "'>
    <br>
    <input type='button' onclick='history.back()' value='戻る'>
    <input type='submit' value='確認OK'>
    </form>
    ");
} else {
    print("<a href='' onclick='history.back()'>戻る</a>");
}
?>
</body>
</html>