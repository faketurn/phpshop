<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>商品登録完了 - 風農園</title>
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
<h1>商品登録完了</h1>

<?php
require_once("../common/escape.php");
$escaped = escape($_POST);

try {
    $product_name = $escaped['name'];
    $product_price = $escaped['price'];
    $product_image_name = $escaped['image_name'];
    
    // データベースに接続する
    $dsn = "mysql:dbname=shop;host=127.0.0.1;charset=utf8mb4";
    $dbh = new PDO(
        $dsn,
        "faketurn",
        "",
        array (
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        )
    );
    
    // SQL
    $sql = "insert into master_product(name, price, image) values (?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    // bindValue(パラメータID,バインドする値,データ型）
    
    $stmt->bindValue(1, $product_name);
    $stmt->bindValue(2, $product_price);
    $stmt->bindValue(3, $product_image_name);
    $stmt->execute();
    
    // fetchAllメソッドで全件取得したものを連想配列で保持する
    // $rows = $stmt->fetchAll();
    // var_dump($rows);
    // print_r($rows);
    print("{$product_name}を追加しました。");

    
} catch (PDOException $e) {
    $error = $e->getMessage();
}

?>

<p><a href="product_list.php">商品一覧へ</a></p>

</body>
</html>