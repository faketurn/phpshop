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
require_once("../common/escape.php");

$post = escape($_POST);

$customer_name = $post['customer_name'];
$email = $post['email'];
$postal1 = $post['postal1'];
$postal2 = $post['postal2'];
$address = $post['address'];
$tel = $post['tel'];

$flag = true;

if ($cusotmer_name === '') {
    print("<p>お名前がにゅうりょくされていません</p>");
    $flag = false;
} else {
    print("<p>お名前：{$customer_name}</p>");
}

if (!preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/', $email)) {
    print("<p>メールアドレスを正確に入力してください</p>");
    $flag = false;
} else {
    print("<p>メールアドレス：{$email}</p>");
}

if (!preg_match('/^[0-9]+$/', $postal1)) {
    print("<p>郵便番号は半角数字で入力してください</p>");
    $flag = false;
} else {
    print("<p>郵便番号：{$postal1}-{$postal2}</p>");
}

if (!preg_match('/^[0-9]+$/', $postal2)) {
    print("<p>郵便番号は半角数字で入力してください</p>");
    $flag = false;
}

if ($address === '') {
    print("<p>住所が入力されていません</p>");
    $flag = false;
} else {
    print("<p>住所：{$address}</p>");
}

if (!preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/', $tel)) {
    print("<p>電話番号を正確に入力してください</p>");
    $flag = false;
} else {
    print("<p>電話番号：{$tel}</p>");
}


if ($flag) {
    print("
    <form method='post' action='shop_form_done.php'>
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
} else {
    print("
    <form>
    <p><input type='button' onclick='history.back()' value='戻る'></p>
    </form>
    ");
}
?>
</body>
</html>