<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>カート - 風農園</title>
<link rel="stylesheet" href="../css/style.css">
<?php

session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) === false) {
    print("<p>ようこそゲスト様 <a href='../member_login.html'>会員ログイン画面へ</a>");
} else {
    print("<p>ようこそ{$_SESSION['staff_name']}様 <a href='member_logout.php'>ログアウト</a></p>");
}

?>
</head>
<body>
<h1>カート</h1>

<?php
try {
    // ユーザー入力からの値ではないので、あえてエスケープせずに代入する
    $product_code = $_GET['productcode'];
    
    if (isset($_SESSION['cart']) === true) {
        // カート2回目以降のセッション受け取る
        $cart = $_SESSION['cart'];
        $product_num = $_SESSION['product_num'];
    }
    $cart[] = $product_code;
    $product_num[] = 1;
    $_SESSION['cart'] = $cart;
    $_SESSION['product_num'] = $product_num;
    
    // $cart確認用コード
    foreach ($cart as $key => $value) {
        print("{$value}<br>");
    }
    
    
} catch (PDOException $e) {
    $error = $e->getMessage();
}
?>

<p>カートに追加しました</p>
<p><a href="shop_list.php">商品一覧へ</a></p>

</body>
</html>