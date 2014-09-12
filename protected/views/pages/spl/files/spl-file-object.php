<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'SplFileObject.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Работа с файлами', 'url' => '/spl/files/'),
        array('title' => 'SplFileObject')
    )
);
echo $view->render(
    'partials/syntax_highlighter.php',
    array(
        'brushes' => array('Php')
    )
);
?>

<h2>Описание</h2>
<p>
    Позволяет манипулировать файлом в ООП стиле.
</p>
<p>
    Может работать как итератор, при этом перебираются строки.
</p>
<p>
    Большинство методов просто альтернатива стандартным функциям PHP.
</p>

<h2>Использование</h2>
<p>
    Прочитаем все строки из файла.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$file = new SplFileObject(__DIR__ . '/test/test.csv');
foreach ($file as $num => $line) {
    echo "$num: $line";
}
]]></script>

<pre>
<?php
$file = new SplFileObject(__DIR__ . '/test/test.csv');
foreach ($file as $num => $line) {
    echo "$num: $line";
}
?>
</pre>

<h2>Флаги</h2>
<p>
    С помощью них манипулируют поведением.
</p>
<ul>
    <li><code>DROP_NEW_LINE</code> - отбрасывается символ переноса строки в конце каждой строки</li>
    <li><code>READ_AHEAD</code> - выполняет чтение при использовании <code>rewind/next</code>. Без этого флага надо всегда вызывать <code>current</code>, иначе будет бесконечный цикл.</li>
    <li><code>SKIP_EMPTY</code> - пропускать пустые строки</li>
    <li><code>READ_CSV</code> - читать строки в CSV формате</li>
</ul>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$file = new SplFileObject(__DIR__ . '/test/test.csv');

echo "--DROP_NEW_LINE\n";
$file->setFlags(SplFileObject::DROP_NEW_LINE);
foreach ($file as $num => $line) {
    echo "$num: $line\n";
}

echo "\n--SKIP_EMPTY\n";
$file->setFlags(SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
foreach ($file as $num => $line) {
    echo "$num: $line\n";
}

echo "\n--READ_CSV\n";
$file->setFlags(SplFileObject::READ_CSV);
foreach ($file as $num => $line) {
    var_dump($line);
}

echo "\n--READ_AHEAD\n";
// without READ_AHEAD flag it cause infinite loop
$file->setFlags(SplFileObject::READ_AHEAD);
echo "count: " . iterator_count($file) . "\n";
]]></script>
<pre>
<?php
$file = new SplFileObject(__DIR__ . '/test/test.csv');

echo "--DROP_NEW_LINE\n";
$file->setFlags(SplFileObject::DROP_NEW_LINE);
foreach ($file as $num => $line) {
    echo "$num: $line\n";
}

echo "\n--SKIP_EMPTY\n";
$file->setFlags(SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
foreach ($file as $num => $line) {
    echo "$num: $line\n";
}

echo "\n--READ_CSV\n";
$file->setFlags(SplFileObject::READ_CSV);
foreach ($file as $num => $line) {
    var_dump($line);
}

echo "\n--READ_AHEAD\n";
// without READ_AHEAD flag it cause infinite loop
$file->setFlags(SplFileObject::READ_AHEAD);
echo "count: " . iterator_count($file) . "\n";
?>
</pre>

<h2>Чтение CSV файлов</h2>
<p>
    Вы наверное уже заметили, что <code>SplFileObject</code> может автоматом парсить CSV файлы. Для этого надо просто указать флаг <code>SplFileObject::READ_CSV</code>.
</p>
<p>
    Но заметьте, для того чтобы пропускать пустые строки надо указать 3 флага: <code>SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE | SplFileObject::READ_CSV</code>.
</p>
<p>
    Для определения формата файла используйте метод <code>setCsvControl</code>.
</p>
<ul>
    <li>Первый аргумент - разделитель полей. По дефолту - ,</li>
    <li>Второй аргумент - символ определения начала и конца поля. По дефолту - ". Используется когда поле занимает несколько строк или внутри него есть символы разделителя полей.</li>
    <li>Первый аргумент - экранирующий символ. По дефолту - \</li>
</ul>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$file = new SplFileObject(__DIR__ . '/test/not-standart-test.csv');

$file->setFlags(SplFileObject::READ_CSV);
$file->setCsvControl(';', '@');
foreach ($file as $num => $line) {
    var_dump($line);
}
]]></script>
<pre>
<?php
$file = new SplFileObject(__DIR__ . '/test/not-standart-test.csv');

$file->setFlags(SplFileObject::READ_CSV);
$file->setCsvControl(';', '@');
foreach ($file as $num => $line) {
    var_dump($line);
}
?>
</pre>

<h2>Закрытие файлового дескриптора</h2>
<p>
    Подобного не предусмотрели, но есть один трюк. Надо просто вручную удалить объект (добьёмся этого с помощью сборщика мусора).
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$path = __DIR__.'/test/new.txt';
$file = new SplFileObject($path, 'w');

// wouldn't work
//unlink($path);

// this works
$file = null;
unlink($path);
]]></script>
<?php
$path = __DIR__.'/test/new.txt';
$file = new SplFileObject($path, 'w');

// wouldn't work
//unlink($path);

// this works
$file = null;
unlink($path);
?>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.splfileobject.php">Официальная документация</a></li>
</ul>