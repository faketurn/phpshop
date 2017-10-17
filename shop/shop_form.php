<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>お客様情報入力フォーム - 風農園</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>お客様情報入力フォーム</h1>

<p>お客様情報を入力してください</p>
<form method="post" action="shop_form_check.php">
<label>お名前<br>
<input type="text" name="customer_name"></label>

<label>メールアドレス<br>
<input type="text" name="email"></label>

<label>郵便番号<br>
<input type="text" name="postal1"> - <input type="text" name="postal2"></label>

<label>住所<br>
<input type="text" name="address"></label>

<label>電話番号<br>
<input type="text" name="tel"></label>

<p><input type="button" onclick="history.back()" value="戻る"></p>
<input type="submit" value="OK">

</form>

</body>
</html>