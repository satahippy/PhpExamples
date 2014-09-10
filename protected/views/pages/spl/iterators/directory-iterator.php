<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'DirectoryIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'DirectoryIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Итератор, который просто перебирает все файлы в папке.
</p>
<p>
    Этот класс наследуется от <a href="../files/spl-file-info">SplFileInfo</a>, и у него есть некоторые свои особенности, о которых следует знать (как минимум <code>getFileInfo/setInfoClass</code>).
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new DirectoryIterator(__DIR__ . '/test/');
foreach ($it as $file) {
    echo "$file\n";
}
]]></script>

<pre>
<?php
$it = new DirectoryIterator(__DIR__ . '/test/');
foreach ($it as $file) {
    echo "$file\n";
}
?>
</pre>

<h2><code>isDot</code></h2>
<p>
    Помимо прочего, <code>DirectoryIterator</code> сам реализует метод <code>isDot</code>, который проверяет является ли текущий элемент <code>.</code> или <code>..</code>.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new DirectoryIterator(__DIR__ . '/test/');
foreach ($it as $file) {
    if (!$file->isDot()) {
        echo "$file\n";
    }
}
]]></script>

<pre>
<?php
$it = new DirectoryIterator(__DIR__ . '/test/');
foreach ($it as $file) {
    if (!$file->isDot()) {
        echo "$file\n";
    }
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.directoryiterator.php">Официальная документация</a></li>
</ul>