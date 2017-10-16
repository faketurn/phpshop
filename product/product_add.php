<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>商品追加 - 風農園</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>商品追加</h1>

<form method="post" action="product_add_check.php" enctype="multipart/form-data">
<p>商品名を入力してください</p>
<p><input type="text" name="name"></p>

<p>価格を入力してください</p>
<p><input type="text" name="price"></p>

<p>画像を選んでください</p>
<p><input type="file" name="image"></p>


<p><input type="submit" value="送信"></p>
<p><input type="button" onclick="history.back()" value="戻る"></p>
</form>
</body>
</html>