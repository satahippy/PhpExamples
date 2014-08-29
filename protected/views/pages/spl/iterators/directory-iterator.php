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
    <!-- TODO тут ссылка на SplFileInfo -->
    Наследуется от SplFileInfo, поэтому каждый текущий элемент может использовать все полезности класса. 
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
	<li><a href="http://php.net/manual/ru/class.arrayiterator.php">Официальная документация</a></li>
	<li><a href="http://stackoverflow.com/a/16619183/3822548">Флаги ArrayIterator/ArrayObject</a></li>
</ul>