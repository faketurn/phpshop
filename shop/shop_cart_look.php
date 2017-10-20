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
    print("<p>ようこそ{$_SESSION['member_name']}様 <a href='member_logout.php'>ログアウト</a></p>");
}

?>
</head>
<body>
<h1>カート参照</h1>

<?php
try {
    // ユーザー入力からの値ではないので、あえてエスケープせずに代入する
    if (isset($_SESSION['cart']) === true) {
        $cart = $_SESSION['cart'];
        $product_num = $_SESSION['product_num'];
        $cart_max = count($cart);
        $total_price = 0;
    } else {
        $cart_max = 0;
    }
    
    if ($cart_max === 0) {
        print("
        <p>カートに商品が入っていません</p>
        <p><a href='shop_list.php'>商品一覧へ戻る</a></p>
        ");
        exit();
    }
    
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
    
    for ($i=0; $i<$cart_max; $i++):
        $total_price += $product_prices[$i] * $product_num[$i];
    endfor;
    
} catch (PDOException $e) {
    exit($error = $e->getMessage());
}
?>


<form method="post" action="change_num.php">

<table>
<?php for ($i=0; $i<$cart_max; $i++): ?>
<?= "
<tr>
<td class='table_image'>{$specific_images[$i]}</td>
<td>{$product_names[$i]}</td>
<td class='table_num'>{$product_prices[$i]}円</td>
<td class='table_num'><input type='text' name='product_num{$i}' value='" . $product_num[$i] . "'>個</td>
<td class='table_num'>" . $product_prices[$i] * $product_num[$i] . "円</td>
<td class='table_delete'><input type='checkbox' name='delete" . $i . "'></td>
</tr>


" ?>
<?php endfor; ?>
        
</table>

<p class="total_price">商品合計<span><?= $total_price; ?>円</span></p>

<p><input type="hidden" name="cart_max" value="<?= $cart_max; ?>"></p>

<p><input type="submit" value="数量変更"></p>
<p><input type="button" onclick="history.back()" value="戻る"></p>
</form>

<p><a href="shop_form.php">ご購入手続きへ進む</a></p>

<?php
if (isset($_SESSION['member_login']) === true) {
    print("<p><a href='shop_easy_check.php'>会員簡単注文へ進む</a></p>");
}
?>

</body>
</html>