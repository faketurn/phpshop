<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) === false) {
    print("
    <p>ログインされていません</p>
    <p><a href='shop_list.php'>商品一覧へ</a></p>
    ");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>フォーム確認 - 風農園</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>フォーム確認</h1>

<?php
$code = $_SESSION['member_code'];

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
    
    $sql = "select name, email, postal1, postal2, address, tel from data_member where code=?";
    $stmt = $database_handle->prepare($sql);
    $stmt->bindValue(1, $code);
    $stmt->execute();
    $result = $stmt->fetch();
    
    $customer_name = $result['name'];
    $email = $result['email'];
    $postal1 = $result['postal1'];
    $postal2 = $result['postal2'];
    $address = $result['address'];
    $tel = $result['tel'];
    
    print("
    <p>お名前</p>
    <p>{$customer_name}</p>
    
    <p>メールアドレス</p>
    <p>{$email}</p>
    
    <p>郵便番号</p>
    <p>{$postal1}-{$postal2}</p>
    
    <p>住所</p>
    <p>{$address}</p>
    
    <p>電話番号</p>
    <p>{$tel}</p>
    
    ");

    print("
    <form method='post' action='shop_easy_done.php'>
    <p><input type='hidden' name='customer_name' value='{$customer_name}'></p>
    <p><input type='hidden' name='email' value='{$email}'></p>
    <p><input type='hidden' name='postal1' value='{$postal1}'></p>
    <p><input type='hidden' name='postal2' value='{$postal2}'></p>
    <p><input type='hidden' name='address' value='{$address}'></p>
    <p><input type='hidden' name='tel' value='{$tel}'></p>
    <p><input type='button' onclick='history.back()' value='戻る'></p>
    <p><input type='submit' value='OK'></p>
    
    </form>
    ");

} catch (PDOException $e) {
    exit($error = $e->getMessage());
}
?>
</body>
</html>