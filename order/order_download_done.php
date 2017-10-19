<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ダウンロード画面 - 風農園</title>
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
<h1>ダウンロード画面</h1>

<?php
try {
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    
    $data_source_name = "mysql:dbname=shop; host=127.0.0.1; charset=utf8mb4";
    $database_handle = new PDO(
        $data_source_name,
        "faketurn",
        "",
        array (
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        )
    );
    
    $sql = "
    select
        data_sales.code,
        data_sales.date,
        data_sales.code_member,
        data_sales.name as data_sales_name,
        data_sales.email,
        data_sales.postal1,
        data_sales.postal2,
        data_sales.address,
        data_sales.tel,
        data_sales_product.code_product,
        master_product.name as master_product_name,
        data_sales_product.price,
        data_sales_product.quantity
        
    from
        data_sales, data_sales_product, master_product
    where
        data_sales.code = data_sales_product.code_sales
        and data_sales_product.code_product = master_product.code
        and substr(data_sales.date, 1, 4) = ?
        and substr(data_sales.date, 6, 2) = ?
        and substr(data_sales.date, 9, 2) = ?
    order by
        data_sales.code
        ;
    ";
    $stmt = $database_handle->prepare($sql);
    $stmt->bindValue(1, $year);
    $stmt->bindValue(2, $month);
    $stmt->bindValue(3, $day);
    $stmt->execute();
    
    $csv = "注文コード,注文日時,会員番号,お名前,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量";
    $csv .= "\n";
    
    $rows = $stmt->fetchAll();
    
    foreach ($rows as $row) {
        // print("<pre>");
        // var_dump($row);
        // print("</pre>");
        // print("<br>");
        
        $csv .= $row['code'];
        $csv .= ",";
        $csv .= $row['date'];
        $csv .= ",";
        $csv .= $row['code_member'];
        $csv .= ",";
        $csv .= $row['data_sales_name'];
        $csv .= ",";
        $csv .= $row['email'];
        $csv .= ",";
        $csv .= $row['postal1'] . "-" . $row['postal2'];
        $csv .= ",";
        $csv .= $row['address'];
        $csv .= ",";
        $csv .= $row['tel'];
        $csv .= ",";
        $csv .= $row['code_product'];
        $csv .= ",";
        $csv .= $row['master_product_name'];
        $csv .= ",";
        $csv .= $row['price'];
        $csv .= ",";
        $csv .= $row['quantity'];
        $csv .= "\n";
    }
    
    // print nl2br($csv);
    
    $file = fopen("chumon.csv", "w");
    $csv = mb_convert_encoding($csv, "SJIS", "UTF-8");
    fputs($file, $csv);
    fclose($file);
    
} catch (PDOException $e) {
    $error = $e->getMessage();
}


?>

<p><a href="chumon.csv">注文データのダウンロード</a></p>
<p><a href="order_download.php">日付選択へ</a></p>


<p><a href="../staff_login/staff_top.php">トップメニューヘ</a></p>
</body>
</html>