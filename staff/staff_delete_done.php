<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>スタッフ登録完了 - 風農園</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>スタッフ登録完了</h1>

<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, "utf-8");
}

try {
    $staff_code = h($_POST['code']);
    
    // データベースに接続する
    $dsn = "mysql:dbname=shop; host=127.0.0.1; charset=utf8mb4";
    $dbh = new PDO(
        $dsn,
        "faketurn",
        "",
        array (
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        )
    );
    
    // SQL
    $sql = "delete from master_staff where code=?";
    $stmt = $dbh->prepare($sql);
    // bindValue(パラメータID,バインドする値,データ型）
    
    $stmt->bindValue(1, $staff_code);
    // print_r("$staff_name $staff_pass $staff_code");
    $stmt->execute();
    
    // fetchAllメソッドで全件取得したものを連想配列で保持する
    // $rows = $stmt->fetchAll();
    // var_dump($rows);
    // print_r($rows);
    
} catch (PDOException $e) {
    $error = $e->getMessage();
}

?>

<p>削除しました</p>

<p><a href="staff_list.php">スタッフ一覧へ</a></p>

</body>
</html>