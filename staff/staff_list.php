<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>スタッフ一覧 - 風農園</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>スタッフ一覧</h1>

<?php
try {
    $data_source_name = "mysql:dbname=shop; host=127.0.0.1; charset=utf8mb4";
    $database_handle = new PDO(
        $data_source_name,
        "faketurn",
        "",
        array (
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        )
    );
    
    $sql = "select code, name from master_staff where 1";
    $stmt = $database_handle->prepare($sql);
    $stmt->execute();
    
    print("<form method='post' action='staff_branch.php'>");
    
    // fetchAllメソッドで全件取得したものを連想配列で保持する
    $rows = $stmt->fetchAll();
    // echo "<pre>";
    // var_dump($rows);
    // echo "</pre>";
    
    foreach ($rows as $row) {
        print("<label><input type='radio' name='staffcode' value='" . $row['code'] . "'>");
        print($row['name'] . "</label>");
    }
    
    print("<input type='submit' name='specific' value='参照'><br>");
    print("<input type='submit' name='add' value='追加'><br>");
    print("<input type='submit' name='edit' value='修正'><br>");
    print("<input type='submit' name='delete' value='削除'>");
    print("</form>");
    
    // $sql = "select name, password from master_staff where 1";
    // $stmt = $database_handle->prepare($sql);
    // $stmt->execute();
    
    // foreach ($stmt as $row) {
    //     printf("<pre>%s lives in <br /></pre>\n", var_dump($row));
    // }
    
} catch (PDOException $e) {
    $error = $e->getMessage();
}


?>


<p><a href="../staff_login/staff_top.php">トップメニューヘ</a></p>
</body>
</html>