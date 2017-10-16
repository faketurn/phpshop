<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>星 - 風農園</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>星</h1>

<?php
$nebula_num = $_POST['nebula_num'];

$nebulas = array(
    "M1" => "かに星雲",
    "M31" => "アンドロメダ大星雲",
    "M42" => "オリオン大星雲",
    "M45" => "すばる",
    "M57" => "ドーナツ星雲",
    );

foreach ($nebulas as $key => $value) {
    print("<p>{$key}は{$value}</p>");
}

print("あなたが選んだ星は<br>{$nebulas[$nebula_num]}です");


?>
</body>
</html>