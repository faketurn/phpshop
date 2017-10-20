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

<label><input type="radio" name="chumon" value="chumonkonkai" checked>今回だけの注文</label>
<label><input type="radio" name="chumon" value="chumontouroku">会員登録しての注文</label>

<p>※会員登録する方は以下の項目も入力してください</p>

<label>パスワードを入力してください<br>
<input type="password" name="pass"></label>

<label>もう一度パスワードを入力してください<br>
<input type="password" name="pass2"></label>

<p>性別</p>
<label><input type="radio" name="sex" value="male" checked>男性</label>
<label><input type="radio" name="sex" value="female">女性</label>

<label>生まれ年
<select name="birth">
<option value="1910">1910年代</option>
<option value="1920">1920年代</option>
<option value="1930">1930年代</option>
<option value="1940">1940年代</option>
<option value="1950">1950年代</option>
<option value="1960">1960年代</option>
<option value="1970">1970年代</option>
<option value="1980" selected>1980年代</option>
<option value="1990">1990年代</option>
<option value="2000">2000年代</option>
<option value="2010">2010年代</option>
</select>
</label>

<p><input type="button" onclick="history.back()" value="戻る"></p>
<input type="submit" value="OK">

</form>

</body>
</html>