<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'GlobIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'GlobIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Итерирует файлы так, как это делает <code>glob()</code>. Т.е. можно передать маску, по которой будут итерироваться файлы.
</p>
<p>
    Помимо этого есть метод <code>count</code>, благодаря которому можно узнать, сколько файлов попало под маску.
</p>
<p>
    Этот класс наследуется от <a href="../files/spl-file-info">SplFileInfo</a>, и у него есть некоторые свои особенности, о которых следует знать (как минимум <code>getFileInfo/setInfoClass</code>).
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new GlobIterator(__DIR__ . '/test/*.txt');
echo 'Всего ' . $it->count() . " файлов:\n";
foreach ($it as $file) {
    echo "$file\n";
}
]]></script>

<pre>
<?php
$it = new GlobIterator(__DIR__ . '/test/*.txt');
echo 'Всего ' . $it->count() . " файлов:\n";
foreach ($it as $file) {
    echo "$file\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.globiterator.php">Официальная документация</a></li>
</ul>