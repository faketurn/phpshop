# 気づけばプロ並みPHPのコード

参考書籍

- [気づけばプロ並みPHP](http://www.ric.co.jp/book/contents/book_926.html)

## エミュレートをオフにするとエラーが出る問題

詳しいことはわからないが、エミュレートがオフ（false）だとmysqlのlock時にエラーが出た。下記を追加して、エミュレートをオンにすると動作した。
```php
$database_handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
```

### 2017l10.13 Fri

## ■コードの失敗

```php
// 正しいコード
$dsn = "mysql:dbname=hoge; host=localhost; charset=utf8mb4";

// 間違えていたコード
$dsn = "mysql:dbname=hoge, host=localhost, charset=utf8mb4";
```
セミコロンで分割するところを、カンマで区切っていた。……そりゃ動かないわ。

## ■PHPの連想配列の添え字の引用符の必要性

> 連想配列の添字の前後は常に引用符で括る必要があります。 例えば、$foo[bar] ではなく $foo['bar'] を使用してください。<br> - 参照リンク：[PHP: 配列](http://php.net/manual/ja/language.types.array.php)

はっきり書いてくれているので助かる。とにかく引用符はきちんとつけて書くことにしよう。



### 2017.10.12 Thu

## ■はじめてのプログラミング学習

プログラミングの学習をすべて無料でまかのうと効率が悪くなりがちで時間がかかる。効率よくステップアップするには書籍や有料サービスを積極活用すると良い。

初めはpython3からが良いように思う。次にJavaなどの低級言語を触ってみる。あとは自由。ファイルとREPLの両方になれると上達も早い。

#### うまく学習が進まない人へのアドバイス

- なかなか学習が進まない方は、プログラミングの理解と、プログラミング言語の理解は別だと考えてみるといいかもしれない。つまり、プログラミング自体が初めてなのか、一度別の言語でプログラミングしたことがあるけど、このプログラミング言語を触るのは初めてなのかということ。
- 先入観はいちいち捨てていく。プログラミングの習得に必要なことだけ学んでいく。
- ひとつのお手本のみを鵜呑みにしない。2つめ、3つ目の例を見るとまた違った面が見えたりする。
- コピペや書き写しではプログラミングしたとは言えない。理解したかなと感じたら、何も見ずに書けるまで反復練習する。


#### Pythonで学ぶ、初めてのプログラミング
初心者がつまづくところをフォローしてる点がありがたい。平易でわかりやすい説明と必要なところを絞って解説してくれてるのでとっつきやすい。

無料で見られるのはいくつかの動画のみ。全部見るには有料会員を。

- [Pythonで学ぶ、初めてのプログラミング - schoo](https://schoo.jp/class/3447)


## ■PDOを使ってPHPでMySqlを利用する

[PHPでデータベースに接続するときのまとめ
](https://qiita.com/mpyw/items/b00b72c5c95aac573b71)

[【PHP超入門】クラス～例外処理～PDOの基礎
](https://qiita.com/7968/items/6f089fec8dde676abb5b)


### 2017.10.11 Wed

## ■PHPからMySqlのプリペアードステートメントで取得するコードに悪戦苦闘

<http://blog.pionet.co.jp/experience/archives/425>

どうやらもう少しPHPの勉強が必要なようだ。


## ■cloud9上でPHPからMySqlに接続する方法

参考：[MySqlへの接続方法](https://community.c9.io/t/setting-up-mysql/1718/16)

参考：[PHPからデータベースを操作する](https://team-lab.github.io/skillup/1/9.html)

参考：[PHP::fetch_object](http://php.net/manual/ja/mysqli-result.fetch-object.php)

```php
// データベースに接続する
$servername = (localhost);
$username = ('username');
$password = "";
$database = "databasename";
$dbport = 3306;

// Create connection
$db = new mysqli($servername, $username, $password, $database, $dbport);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
// 文字化けしないように文字コードをutf8に指定する
$db->set_charset("utf8");
// 接続成功時の確認メッセージ。不要ならコメント化
echo "Connected successfully (".$db->host_info.")";
```

```php
// データベースにSQLを実行させる
// プリペアドステートメントprepared statementを作成　valuesの各値は?にしておく
$sql = "insert into tablename(columnname1, columnname2, columnname3) values (?, ?, ?)";
$stmt = $db->prepare($sql);

// ?の位置に値を割り当てる sはstringの意味。intならi、binaryならb。
$stmt->bind_param('sss', value1, value2, value3);
//実行
$stmt->execute();
```

```php
// テーブルからデータを取り出す
$query = "select * from tablename where 1";
// テーブルから日付の降順でデータを取得
$result = $db->query($query);
if ($result) {
//   1行ずつ取り出し
  while ($row = $result->fetch_object()) {
    // エスケープして表示
    $value1 = htmlspecialchars($row->valuename1);
    $value2 = htmlspecialchars($row->valuename2);
    $value3 = htmlspecialchars($row->valuename3);
    print("$value1 : $value2 ($value3)<br>");
  }
  $result->close();
}

```

```php
// データベースとの接続を終了する
$db->close();
```
