<?php
require_once("../common/escape.php");

try {
    $post = escape($_POST);
    
    $member_email = $post['email'];
    $member_pass = $post['pass'];
    
    $member_pass = md5($member_pass);
    
    $data_source_name = "mysql:dbname=shop;host=127.0.0.1;charset=utf8mb4";
    $database_handle = new PDO(
        $data_source_name,
        "faketurn",
        "",
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            )
        );
    
    $sql = "select code, name from data_member where email=? and password=?";
    $stmt = $database_handle->prepare($sql);
    $stmt->bindValue(1, $member_email);
    $stmt->bindValue(2, $member_pass);
    $stmt->execute();
    
    $result = $stmt->fetch();
    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";
    
    if ($result) {
        session_start();
        $_SESSION['member_login'] = 1;
        $_SESSION['member_code'] = $result['code'];
        $_SESSION['member_name'] = $result['name'];
        header("Location:shop_list.php");
        exit();
    } else {
        print("<head><meta charset='utf-8'><link rel='stylesheet' href='../css/style.css'></head>");
        print("メールアドレスもしくはパスワードが間違っています<br>");
        print("<a href='member_login.html'>戻る</a>");
    }
    
    
} catch (PDOException $e) {
    $error = $e->getMessage();
}