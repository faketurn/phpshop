<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>スタッフ追加 - 風農園</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>スタッフ追加</h1>

<form method="post" action="staff_add_check.php">
<p>スタッフ名を入力してください</p>
<p><input type="text" name="name"></p>

<p>パスワードを入力してください</p>
<p><input type="password" name="pass"></p>

<p>もう一度パスワードを入力してください</p>
<p><input type="password" name="confirm_pass"></p>

<p><input type="submit" value="送信"></p>
<p><input type="button" onclick="history.back()" value="戻る"></p>
</form>
</body>
</html>