<?php
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), "", time()-42000, "/");
}
@session_destroy();

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>風農園</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>ログアウトしました</h1>

<p><a href="shop_list.php">商品一覧へ</a></p>
</body>
</html>