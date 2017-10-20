<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>商品一覧 - 風農園</title>
<link rel="stylesheet" href="../css/style.css">
<?php

session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) === false) {
    print("<p>ようこそゲスト様 <a href='member_login.html'>会員ログイン画面へ</a>");
} else {
    print("<p>ようこそ{$_SESSION['member_name']}様 <a href='member_logout.php'>ログアウト</a></p>");
}

?>
</head>
<body>
<h1>商品一覧</h1>

<?php
try {
    $data_source_name = "mysql:dbname=shop;host=127.0.0.1;charset=utf8mb4";
    $database_handle = new PDO(
        $data_source_name,
        "faketurn",
        "",
        array (
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        )
    );
    
    $sql = "select code, name, price from master_product where 1";
    $stmt = $database_handle->prepare($sql);
    $stmt->execute();
    
    
    // fetchAllメソッドで全件取得したものを連想配列で保持する
    $rows = $stmt->fetchAll();
    // echo "<pre>";
    // var_dump($rows);
    // echo "</pre>";
    
    foreach ($rows as $row) {
        print("<p><a href='shop_product.php?productcode=" . $row['code'] . "'>");
        print($row['name'] . "： ");
        print($row['price'] . "円</a></p>");
    }
    
    print("<p><a href='shop_cart_look.php'>カートを見る</a></p>");
    
} catch (PDOException $e) {
    exit($error = $e->getMessage());
}


?>


</body>
</html>