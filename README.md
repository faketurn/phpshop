# 気づけばプロ並みPHPのコード

参考書籍

- [気づけばプロ並みPHP](http://www.ric.co.jp/book/contents/book_926.html)

## エミュレートをオフにするとエラーが出る問題

詳しいことはわからないが、エミュレートがオフ（false）だとmysqlのlock時にエラーが出た。下記を追加して、エミュレートをオンにすると動作した。
```php
$database_handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
```