<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, "utf-8");
}

try {
    $staff_code = $_POST['code'];
    $staff_pass = $_POST['pass'];
    
    $staff_code = h($staff_code);
    $staff_pass = h($staff_pass);
    
    $staff_pass = md5($staff_pass);
    
    $data_source_name = "mysql:dbname=shop;host=127.0.0.1;charset=utf8mb4";
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
    
    $sql = "select name from master_staff where code=? and password=?";
    $stmt = $database_handle->prepare($sql);
    $stmt->bindValue(1, $staff_code);
    $stmt->bindValue(2, $staff_pass);
    $stmt->execute();
    
    $result = $stmt->fetch();
    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";
    
    if ($result) {
        session_start();
        $_SESSION['login'] = 1;
        $_SESSION['staff_code'] = $staff_code;
        $_SESSION['staff_name'] = $result['name'];
        header("Location:staff_top.php");
        exit();
    } else {
        print("<head><meta charset='utf-8'><link rel='stylesheet' href='../css/style.css'></head>");
        print("スタッフコードもしくはパスワードが間違っています<br>");
        print("<a href='staff_login.html'>戻る</a>");
    }
    
    
} catch (PDOException $e) {
    $error = $e->getMessage();
}