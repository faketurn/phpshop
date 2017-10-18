<?php
session_start();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ご注文ありがとうございました - 風農園</title>
<link rel="stylesheet" href="../css/style.css">

</head>
<body>
<h1>ご注文ありがとうございました</h1>

<?php
try {
    require_once("../common/escape.php");
    
    $post = escape($_POST);
    
    $customer_name = $post['customer_name'];
    $email = $post['email'];
    $postal1 = $post['postal1'];
    $postal2 = $post['postal2'];
    $address = $post['address'];
    $tel = $post['tel'];
    
    print("
    <p>{$customer_name}様</p>
    <p>ご注文ありがとうございました</p>
    <p>{$email}にメールを送りましたのでご確認ください</p>
    <p>商品は以下の住所に発送させていただきます</p>
    <p>{$postal1}-{$postal2}</p>
    <p>{$address}</p>
    <p>{$tel}</p>
    ");
    
    $email_body = "";
    $email_body .= "{$customer_name}様\n\n";
    $email_body .= "このたびはご注文ありがとうございました\n";
    $email_body .= "ご注文商品\n";
    $email_body .= "--\n";
    
    $cart = $_SESSION['cart'];
    $product_num = $_SESSION['product_num'];
    $cart_max = count($cart);
    
    
    $data_source_name = "mysql:dbname=shop;host=127.0.0.1;charset=utf8mb4";
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
    
    for ($i=0; $i<$cart_max; $i++) {
        $sql = "select name, price from master_product where code=?";
        $stmt = $database_handle->prepare($sql);
        $stmt->bindValue(1, $cart[$i]);
        $stmt->execute();
        
        $result = $stmt->fetch();
        
        $name = $result['name'];
        $price = $result['price'];
        $prices[] = $price;
        $product_amount = $product_num[$i];
        $total = $price * $product_amount;
        
        $email_body .= "{$name} ";
        $email_body .= "{$price}円 × ";
        $email_body .= "{$product_amount}個 = ";
        $email_body .= "{$total}円\n";
        
    }
    
    
    // ロック処理 エミュレートをオンにしないとバインドできないようだ！？
    $database_handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

    $sql = "lock tables data_sales write,data_sales_product write";
    $stmt = $database_handle->prepare($sql);
    $stmt->execute();
    
    // 注文データ登録
    $sql = "insert into data_sales (code_member, name, email, postal1, postal2, address, tel) values (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $database_handle->prepare($sql);
    $stmt->bindValue(1, 0);
    $stmt->bindValue(2, $customer_name);
    $stmt->bindValue(3, $email);
    $stmt->bindValue(4, $postal1);
    $stmt->bindValue(5, $postal2);
    $stmt->bindValue(6, $address);
    $stmt->bindValue(7, $tel);
    $stmt->execute();
    
    $sql = "select last_insert_id()";
    $stmt = $database_handle->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    $lastcode = $result['last_insert_id()'];
    
    // 注文詳細データ登録
    // print($cart_max);
    for ($i=0; $i<$cart_max; $i++) {
        print("forの中{$i}");
        $sql = "insert into data_sales_product (code_sales, code_product, price, quantity) values (?, ?, ?, ?)";
        $stmt = $database_handle->prepare($sql);
        $stmt->bindValue(1, $lastcode);
        $stmt->bindValue(2, $cart[$i]);
        $stmt->bindValue(3, $prices[$i]);
        $stmt->bindValue(4, $product_num[$i]);
        $stmt->execute();
    }
    
    $sql = "unlock tables";
    $stmt = $database_handle->prepare($sql);
    $stmt->execute();
    
    
    $email_body .= "送料は無料です\n";
    $email_body .= "--\n";
    $email_body .= "代金は以下の口座にお振込みください\n";
    $email_body .= "ろくまる銀行 やさい支店 普通口座 1234456789\n";
    $email_body .= "入金の確認が取れ次第、梱包、発送させていただきます\n";
    $email_body .= "**\n";
    $email_body .= "あなざ県へぶん市りー町\n";
    $email_body .= "電話 777-77-7777\n";
    $email_body .= "**\n";
    
    // print nl2br($email_body);
    
    $title = "ご注文ありがとうございます";
    $header = "From:info@example.com";
    $email_body = html_entity_decode($email_body, ENT_QUOTES, "utf-8");
    mb_language("Japanese");
    mb_internal_encoding('UTF-8');
    mb_send_mail($email, $title, $email_body, $header);
    
    $title = "お客様から注文がありました";
    $header = "From:{$email}";
    $email_body = html_entity_decode($email_body, ENT_QUOTES, "utf-8");
    mb_language("Japanese");
    mb_internal_encoding('UTF-8');
    mb_send_mail("info@example.com", $title, $email_body, $header);
    
} catch (PDOException $e) {
    exit($error = $e->getMessage());
}


?>


</body>
</html>