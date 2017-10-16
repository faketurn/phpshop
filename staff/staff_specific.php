<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>スタッフ参照 - 風農園</title>
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
<h1>スタッフ参照</h1>

<?php
try {
    // ユーザー入力からの値ではないので、あえてサニタイズせずに代入する
    $staff_code = $_GET['staffcode'];
    
    $data_source_name = "mysql:dbname=shop; host=127.0.0.1; charset=utf8mb4";
    $database_handle = new PDO(
        $data_source_name,
        "faketurn",
        "",
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        )
    );
    
    $sql = "select name from master_staff where code = ?";
    $stmt = $database_handle->prepare($sql);
    $stmt->bindValue(1, $staff_code);
    $stmt->execute();
    
    $result = $stmt->fetch();
    $staff_name = $result['name'];
    // echo $staff_name;
    
} catch (PDOException $e) {
    $error = $e->getMessage();
}
?>

<p>スタッフコード<br>
<strong><?= $staff_code ?></strong></p>

<p>スタッフ名<br>
<strong><?= $staff_name ?></strong></p>

<form>
<p><input type="button" onclick="history.back()" value="戻る"></p>
</form>

</body>
</html>