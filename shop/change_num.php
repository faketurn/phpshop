<?php

session_start();
session_regenerate_id(true);

require_once('../common/escape.php');

$post = escape($_POST);

$cart_max = $post['cart_max'];
for ($i=0; $i<$cart_max; $i++) {
    $product_num[] = $post['product_num' . $i];
}
$_SESSION['product_num'] = $product_num;

header("Location:shop_cart_look.php");