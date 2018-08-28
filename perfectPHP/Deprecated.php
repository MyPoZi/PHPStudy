<?php
echo 'テストプログラム開始',PHP_EOL;
$tags_string = 'one,two,three';
$tags = str_split('two');

print_r($tags);

$tags_string2 = 'one,two,three';
$tags2 = explode(',',$tags_string2);

print_r($tags2);
echo 'テストプログラム終了',PHP_EOL;

// PhpStormだとPHP5バージョンのsplit関数は打消し線で消される。PHP7なので、もちろん使えない。
// TODO: 打消し線意味

