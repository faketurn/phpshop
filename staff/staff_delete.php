<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>スタッフ削除 - 風農園</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>スタッフ削除</h1>

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

<p>スタッフコード<br><strong><?= $staff_code ?></strong></p>
スタッフ名<br>
<p><strong><?= $staff_name ?></strong>を削除してよろしいですか？</p>

<form method="post" action="staff_delete_done.php">
<p><input type="hidden" name="code" value="<?= $staff_code ?>"></p>

<p><input type="submit" value="削除する"></p>
<p><input type="button" onclick="history.back()" value="戻る"></p>
</form>

</body>
</html>