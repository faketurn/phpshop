<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>旬 - 風農園</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>旬</h1>

<?php
$month = $_POST['month'];

$vegetable = array(
    1 => "ブロッコリー",
    "カリフラワー",
    "レタス",
    "みつば",
    "アスパラガス",
    "セロリ",
    "茄子",
    "ピーマン",
    "さつまいも",
    "オクラ",
    "大根",
    "ほうれんそう",
    );

print("{$month}月は{$vegetable[$month]}が旬です");


?>
</body>
</html>