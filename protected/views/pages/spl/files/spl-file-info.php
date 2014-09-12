<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'SplFileInfo.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Работа с файлами', 'url' => '/spl/files/'),
        array('title' => 'SplFileInfo')
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
    Предоставляет ООП доступ к информации о файле. И этой информации достаточно много.
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$fileInfo = new SplFileInfo(__DIR__ . '/test/just-a-file.txt');
echo "filename: " . $fileInfo->getFilename() . "\n";
echo "without extension: " . $fileInfo->getBasename('.txt') . "\n";
echo "extension: " . $fileInfo->getExtension() . "\n";
echo "path: " . $fileInfo->getRealPath() . "\n";
echo "size: " . $fileInfo->getSize() . "\n";
echo "mtime: " . date('Y-m-d H:i:s', $fileInfo->getMTime()) . "\n";
]]></script>

<pre>
<?php
$fileInfo = new SplFileInfo(__DIR__ . '/test/just-a-file.txt');
echo "filename: " . $fileInfo->getFilename() . "\n";
echo "without extension: " . $fileInfo->getBasename('.txt') . "\n";
echo "extension: " . $fileInfo->getExtension() . "\n";
echo "path: " . $fileInfo->getRealPath() . "\n";
echo "size: " . $fileInfo->getSize() . "\n";
echo "mtime: " . date('Y-m-d H:i:s', $fileInfo->getMTime()) . "\n";
?>
</pre>

<h2>Проверочные методы</h2>
<ul>
    <li><code>isDir</code> - является ли файл директорией</li>
    <li><code>isFile</code> - является ли файл обычным файлом</li>
    <li><code>isLink</code> - является ли файл ссылкой</li>
    <li><code>isReadable</code> - доступен ли файл для чтения</li>
    <li><code>isWritable</code> - доступен ли файл для записи</li>
    <li><code>isExecutable</code> - является ли файл исполняемым</li>
</ul>

<h2><code>getFilename</code> vs <code>getBasename</code></h2>
<p>
    По сути они ничем не отличаются. Но <code>getBasename</code> - может отбрасывать указанный суффикс.
</p>

<h2><code>getPath</code> vs <code>getPathname</code> vs <code>getRealPath</code></h2>
<p>
    <code>getPathname</code> - просто отдаёт путь к файлу. На самом деле он просто отдаёт то, что было передано в конструкторе.
</p>
<p>
    <code>getPath</code> - отдаёт путь к директории содержащей файл (без замыкающего слэша). Тоже самое, можно получить если вызывать
    <code>dirname</code> на аргумент конструктора.
</p>
<p>
    <code>getRealPath</code> - разрешает все ссылки и относительные пути и возвращает абсолютный путь. Если файл не существует возвращает
    <code>false</code>.
</p>
<p>
    При этом <code>getPathname</code> и
    <code>getPath</code> не приводят путь к какому либо виду. Т.е. если вы передали мясо из разных слэшей и
    <code>..</code>, примерно тоже самое вам и вернётся.
    <br/>
    <code>getRealPath</code> использует слэши определённые ОС.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
echo "--existing file\n";
$fileInfo = new SplFileInfo(__DIR__ . '/test/../test/just-a-file.txt');
echo "getPathname: " . $fileInfo->getPathname() . "\n";
echo "getPath: " . $fileInfo->getPath() . "\n";
echo "getRealPath: " . $fileInfo->getRealPath() . "\n";

echo "\n--not existing file\n";
$fileInfo = new SplFileInfo(__DIR__ . '/test/nope');
echo "getPathname: " . $fileInfo->getPathname() . "\n";
echo "getPath: " . $fileInfo->getPath() . "\n";
echo "getRealPath: " . $fileInfo->getRealPath() . "\n";
]]></script>
<pre>
<?php
echo "--existing file\n";
$fileInfo = new SplFileInfo(__DIR__ . '/test/../test/just-a-file.txt');
echo "getPathname: " . $fileInfo->getPathname() . "\n";
echo "getPath: " . $fileInfo->getPath() . "\n";
echo "getRealPath: " . $fileInfo->getRealPath() . "\n";

echo "\n--not existing file\n";
$fileInfo = new SplFileInfo(__DIR__ . '/test/nope');
echo "getPathname: " . $fileInfo->getPathname() . "\n";
echo "getPath: " . $fileInfo->getPath() . "\n";
echo "getRealPath: " . $fileInfo->getRealPath() . "\n";
?>
</pre>

<h2>ATime vs CTime vs MTime</h2>
<p>
    Небольшой ликбез:
</p>
<ul>
    <li><b>ATime</b> - время последнего доступа к файлу</li>
    <li><b>MTime</b> - время модификации содержимого файла</li>
    <li><b>CTime</b> - время модификации информации файла, это может быть изменение владельцев, параметров доступа, перемещение самого файла. При изменении содержимого файла, это значение тоже меняется.</li>
</ul>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$fileInfo = new SplFileInfo(__DIR__ . '/test/just-a-file.txt');
echo "atime: " . date('Y-m-d H:i:s', $fileInfo->getATime()) . "\n";
echo "mtime: " . date('Y-m-d H:i:s', $fileInfo->getMTime()) . "\n";
echo "ctime: " . date('Y-m-d H:i:s', $fileInfo->getCTime()) . "\n";
]]></script>
<pre>
<?php
$fileInfo = new SplFileInfo(__DIR__ . '/test/just-a-file.txt');
echo "atime: " . date('Y-m-d H:i:s', $fileInfo->getATime()) . "\n";
echo "mtime: " . date('Y-m-d H:i:s', $fileInfo->getMTime()) . "\n";
echo "ctime: " . date('Y-m-d H:i:s', $fileInfo->getCTime()) . "\n";
?>
</pre>

<h2><code>getPathInfo/getFileInfo/setInfoClass</code></h2>
<p>
    <code>getFileInfo</code> - возвращает объект <code>SplFileInfo</code> для текущего файла. 
</p>
<p>
    <code>getPathInfo</code> - возвращает объект <code>SplFileInfo</code> для директории содержащей текущий файл.
</p>
<p>
    <code>setInfoClass</code> - устанавливает класс, объекты которого будут возвращаться в <code>getFileInfo</code> и <code>getPathInfo</code>. Должен наследоваться от <code>SplFileInfo</code>.
</p>
<p>
    Если с <code>getPathInfo</code> ещё более менее ясно, то <code>getFileInfo</code> вообще не понятно для чего.
</p>
<p>
    На самом деле эти методы предназначены для наследников <code>SplFileInfo</code>, а именно для <a href="spl-file-object">SplFileObject</a> и всех итераторов директорий (каждый из них так или иначе наследуется от <code>SplFileInfo</code>).
</p>
<p>
    <code>SplFileObject</code> предназначен для манипуляции файлом и через него можно получить информацию о файле (с помощью метода <code>getFileInfo</code>), тут то как раз и вернётся наш кастомный класс. 
</p>
<p>
    А вот для итераторов он просто незаменим. Например для итератора <a href="../iterators/filesystem-iterator">FilesystemIterator</a> каждый элемент будет объектом нашего класса.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class MyFileInfo extends SplFileInfo
{
}

$it = new FilesystemIterator(__DIR__ . '/test/');
$it->setInfoClass('MyFileInfo');
foreach ($it as $file) {
    echo "(" . get_class($file) . ") $file\n";
}
]]></script>
<pre>
<?php

class MyFileInfo extends SplFileInfo
{
}

$it = new FilesystemIterator(__DIR__ . '/test/');
$it->setInfoClass('MyFileInfo');
foreach ($it as $file) {
    echo "(" . get_class($file) . ") $file\n";
}
?>
</pre>

<h2><code>setFileClass/openFile</code></h2>
<p>
    В принципе эта пара имеет тоже значение, что и пара <code>setInfoClass/getFileInfo</code>.
</p>
<p>
    <code>openFile</code> - возвращает объект <code>SplFileObject</code> текущего файла.
</p>
<p>
    <code>setFileClass</code> - устанавливает класс, объекты которого будут возвращаться <code>openFile</code>. Должен наследоваться от <code>SplFileObject</code>.
</p>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.splfileinfo.php">Официальная документация</a></li>
    <li><a href="http://www.linux-faqs.info/general/difference-between-mtime-ctime-and-atime">Различия между mtime, ctime и atime</a></li>
</ul>