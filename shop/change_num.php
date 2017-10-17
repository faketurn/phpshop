<?php

session_start();
session_regenerate_id(true);

require_once('../common/escape.php');

$post = escape($_POST);

$cart_max = $post['cart_max'];
for ($i=0; $i<$cart_max; $i++) {
    if (preg_match("/^[0-9]+$/", $post['product_num' . $i]) === 0) {
        print("
        <head><meta charset='utf-8'></head>
        <p>数量に誤りがあります</p>
        <p><a href='shop_cart_look.php'>カートに戻る</a></p>
        ");
        exit();
    }
    
    if ($post['product_num' . $i] < 1 or 10 < $post['product_num' . $i]) {
        print("
        <head><meta charset='utf-8'></head>
        <p>数量は必ず1個以上、10個までです</p>
        <p><a href='shop_cart_look.php'>カートに戻る</a></p>
        ");
        exit();
    }
    $product_num[] = $post['product_num' . $i];
}

$cart = $_SESSION['cart'];

for ($i=$cart_max; $i>=0; $i--) {
    if (isset($_POST['delete' . $i]) === true) {
        array_splice($cart, $i, 1);
        array_splice($product_num, $i , 1);
    }
}

$_SESSION['cart'] = $cart;
$_SESSION['product_num'] = $product_num;

header("Location:shop_cart_look.php");