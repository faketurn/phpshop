<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>商品参照 - 風農園</title>
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
<h1>商品参照</h1>

<?php
try {
    // ユーザー入力からの値ではないので、あえてエスケープせずに代入する
    $product_code = $_GET['productcode'];
    
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
    
    $sql = "select name, price, image from master_product where code = ?";
    $stmt = $database_handle->prepare($sql);
    $stmt->bindValue(1, $product_code);
    $stmt->execute();
    
    $result = $stmt->fetch();
    $product_name = $result['name'];
    $product_price = $result['price'];
    $product_image_name = $result['image'];
    
    if ($product_image_name) {
        $specific_image = "<img src='image/" . $product_image_name . "' alt=''>";
    } else {
        $specific_image = "";
    }
    // echo $product_name;
    
} catch (PDOException $e) {
    $error = $e->getMessage();
}
?>

<p>商品コード<br>
<strong><?= $product_code ?></strong></p>

<p>商品名<br>
<strong><?= $product_name ?></strong></p>

<p>価格<br>
<strong><?= $product_price ?>円</strong></p>

<p><?= $specific_image ?></p>

<form>
<p><input type="button" onclick="history.back()" value="戻る"></p>
</form>

</body>
</html>