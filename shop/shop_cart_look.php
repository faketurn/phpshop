<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>カート参照 - 風農園</title>
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
<h1>カート参照</h1>

<?php
try {
    // ユーザー入力からの値ではないので、あえてエスケープせずに代入する
    $cart = $_SESSION['cart'];
    $product_num = $_SESSION['product_num'];
    $cart_max = count($cart);
    // print("<pre>");
    // var_dump($cart);
    // print("</pre>");
    // exit();
    
    $data_source_name = "mysql:dbname=shop;host=127.0.0.1;charset=utf8mb4";
    $database_handle = new PDO(
        $data_source_name,
        "faketurn",
        "",
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        )
    );
    
    if ($cart) {
        foreach ($cart as $key => $value) {
            $sql = "select name, price, image from master_product where code = ?";
            $stmt = $database_handle->prepare($sql);
            $stmt->bindValue(1, $value);
            $stmt->execute();
            
            $result = $stmt->fetch();
            $product_names[] = $result['name'];
            $product_prices[] = $result['price'];
            
            if ($result['image']) {
                $specific_images[] = "<img src='../product/image/" . $result['image'] . "' alt=''>";
            } else {
                $specific_images[] = "";
            }
        }
    } else {
        print("カートは空です");
    }
    
} catch (PDOException $e) {
    $error = $e->getMessage();
}
?>


<form method="post" action="change_num.php">

<?php for ($i=0; $i<$cart_max; $i++): ?>
<?= "<p>{$product_names[$i]}</p>
<p>{$specific_images[$i]}</p>
<p>{$product_prices[$i]}円
<input type='text' name='product_num{$i}' value='" . $product_num[$i] . "'>個</p>
<p>合計：" . $product_prices[$i] * $product_num[$i] . "円</p>


" ?>
<?php endfor; ?>
        


<p><input type="hidden" name="cart_max" value="<?= $cart_max; ?>"></p>
<p><input type="submit" value="数量変更"></p>
<p><input type="button" onclick="history.back()" value="戻る"></p>
</form>

</body>
</html>