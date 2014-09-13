<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'SplTempFileObject.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Работа с файлами', 'url' => '/spl/files/'),
        array('title' => 'SplTempFileObject')
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
    Наследник <a href="spl-file-object">SplFileObject</a>, позволяет создавать и работать с временными файлами.
</p>

<h2>Использование</h2>
<p>
    Создадим временный файл, запишем туда пару строк, а потом их прочитаем.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$tmp = new SplTempFileObject();
$tmp->fwrite("my first line!\n");
$tmp->fwrite("the second line is nothing...");
foreach ($tmp as $num => $line) {
    echo "$num: $line";
}
]]></script>

<pre>
<?php
$tmp = new SplTempFileObject();
$tmp->fwrite("my first line!\n");
$tmp->fwrite("the second line is nothing...");
foreach ($tmp as $num => $line) {
    echo "$num: $line";
}
?>
</pre>

<h2>Размер временного файла</h2>
<p>
    Дело в том, что временный файл хранится в памяти до тех пор, пока он не превысит максимальный размер, после этого он сбрасывается в системную временную папку.
</p>
<p>
    Его максимальный размер задаётся в конструкторе:
</p>
<ul>
    <li>0 - файл не будет храниться в памяти</li>
    <li>отрицательное значение - используется только память</li>
    <li>любое другое - после превышения этого значения файл помещается в системную временную папку. По дефолту - 2МБ</li>
</ul>

<h2>Пути ко временным файлам</h2>
<p>
    Всё просто, вы его не можете получить. Не зависимо от того, что используется память или системная временная папка.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$tmp = new SplTempFileObject(0);
echo "system temp: " . $tmp->getRealPath() . "\n";
$tmp = new SplTempFileObject(-1);
echo "memory: " . $tmp->getRealPath() . "\n";
]]></script>

<pre>
<?php
$tmp = new SplTempFileObject(0);
echo "system temp: " . $tmp->getRealPath() . "\n";
$tmp = new SplTempFileObject(-1);
echo "memory: " . $tmp->getRealPath() . "\n";
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.spltempfileobject.php">Официальная документация</a></li>
</ul>