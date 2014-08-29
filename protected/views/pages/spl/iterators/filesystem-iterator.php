<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'FilesystemIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'FilesystemIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
    Продвинутая версия <a href="directory-iterator">DirectoryIterator</a>. 
</p>

<h2>DirectoryIterator vs FilesystemIterator</h2>
<p>
    Итак, эти два итератора делают одно и то же, в чём же различия и зачем они существуют?
</p>
<p>
    Существуют два итератор а не один по историческим причинам.
</p>
<p>
    <code>DirectoryIterator</code> возвращает в <code>current</code> ссылку на себя. А <code>FilesystemIterator</code> создаёт <code>SplFileInfo</code> для каждого элемента в итераторе.
</p>
<p>
    <code>DirectoryIterator</code> всегда возвращает в ключе индекс, а в значении ссылку на себя, <code>FilesystemIterator</code> позволяет определить своё поведение с помощью флагов.
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new FilesystemIterator(__DIR__ . '/test/');
foreach ($it as $file) {
    echo "$file\n";
}
]]></script>

<pre>
<?php
$it = new FilesystemIterator(__DIR__ . '/test/');
foreach ($it as $file) {
    echo "$file\n";
}
?>
</pre>

<h2>Флаги</h2>
<p>
    Как было сказано, <code>FilesystemIterator</code> позволяет определить своё поведение с помощью флагов.
</p>
<h3>Можно определить, кто будет возвращать в <code>key</code></h3>
<ul>
    <li><code>KEY_AS_PATHNAME</code> - путь к файлу</li>
    <li><code>KEY_AS_FILENAME</code> - возвращает имя файла</li>
</ul>
<h3>Так же и <code>current</code></h3>
<ul>
    <li><code>CURRENT_AS_PATHNAME</code> - путь к файлу</li>
    <li><code>CURRENT_AS_FILEINFO</code> - возвращает <code>SplFileInfo</code></li>
    <li><code>CURRENT_AS_SELF</code> - возвращает ссылку на себя, как <code>DirectoryIterator</code></li>
</ul>
<p>
    Есть ещё один флаг <code>NEW_CURRENT_AND_KEY</code> - который используется по дефолту и равносилен <code>KEY_AS_FILENAME | CURRENT_AS_FILEINFO</code>.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new FilesystemIterator(__DIR__ . '/test/', FilesystemIterator::NEW_CURRENT_AND_KEY);
echo "--NEW_CURRENT_AND_KEY\n";
foreach ($it as $key => $val) {
    echo "$key: {$val->getPath()}\n";
}

echo "\n--KEY_AS_PATHNAME and CURRENT_AS_PATHNAME\n";
$it->setFlags(FilesystemIterator::KEY_AS_PATHNAME | FilesystemIterator::CURRENT_AS_PATHNAME);
foreach ($it as $key => $val) {
    echo "$key: $val\n";
}

echo "\n--KEY_AS_FILENAME and CURRENT_AS_SELF\n";
$it->setFlags(FilesystemIterator::KEY_AS_FILENAME | FilesystemIterator::CURRENT_AS_SELF);
foreach ($it as $key => $val) {
    echo "$key: $val\n";
}
]]></script>

<pre>
<?php
$it = new FilesystemIterator(__DIR__ . '/test/', FilesystemIterator::NEW_CURRENT_AND_KEY);
echo "--NEW_CURRENT_AND_KEY\n";
foreach ($it as $key => $val) {
    echo "$key: {$val->getPath()}\n";
}

echo "\n--KEY_AS_PATHNAME and CURRENT_AS_PATHNAME\n";
$it->setFlags(FilesystemIterator::KEY_AS_PATHNAME | FilesystemIterator::CURRENT_AS_PATHNAME);
foreach ($it as $key => $val) {
    echo "$key: $val\n";
}

echo "\n--KEY_AS_FILENAME and CURRENT_AS_SELF\n";
$it->setFlags(FilesystemIterator::KEY_AS_FILENAME | FilesystemIterator::CURRENT_AS_SELF);
foreach ($it as $key => $val) {
    echo "$key: $val\n";
}
?>
</pre>

<h3>Остальные флаги</h3>
<ul>
    <li><code>SKIP_DOTS</code> - будет пропускать элементы <code>.</code> и <code>..</code>. Используется по дефолту</li>
    <li><code>UNIX_PATHS</code> - пути будут использовать обратный слэш независимо от настроек системы</li>
</ul>
<p>
    Но на самом деле <code>UNIX_PATHS</code> будут использоваться обратные слэши только в директориях обходимых итератором. Т.е. если вы начали обходить <code>C:\folder</code>, то резултат будет следующим: <code>C:\folder/test</code>
</p>
<p>
    По поводу <code>SKIP_DOTS</code>. У меня так и не получилось заставить итератор <b>не</b> пропускать точки...
</p>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.filesystemiterator.php">Официальная документация</a></li>
    <li><a href="http://paulyg.github.io/blog/2014/06/03/directoryiterator-vs-filesystemiterator.html">Мужик коротко рассказывает о различиях между <code>DirectoryIterator</code> и <code>FilesystemIterator</code></a></li>
</ul>