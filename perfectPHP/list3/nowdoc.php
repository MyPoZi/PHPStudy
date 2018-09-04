<?php
$age = 15;

$foo = <<< EOI
Tom の年齢は "$age" 歳です


EOI;

echo $foo;


$doc = <<<'EOI'
Nowdoc では、終端識別子をシングルクオートで囲みます。
複数行にわたる文章をそのまま表記することが出来ます。
Tom の年齢は "$age" 歳です
この $age は展開されない


EOI;

echo $doc;

class NowDocTest
{
    const DOCUMENT1 = <<<'EOI'
const指定できる


EOI;

    const DOCUMENT2 = <<< EOI
\$foo エスケープ処理すればok!！

EOI;


}
echo NowDocTest::DOCUMENT1;
echo NowDocTest::DOCUMENT2;

