<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'SplMinHeap.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Структуры данных', 'url' => '/spl/datastructures/'),
	array('title' => 'SplMinHeap')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Ещё одна реализация <code>SplHeap</code>. Делает тоже самое, что и <a href="spl-max-heap">SplMaxHeap</a>, только минимальный элемент всегда остаётся на вершине.
</p>
<p>
	Недостатки такие же. Не всегда понятно, как будут сравниваться некоторые типы переменных.
</p>

<h2>Базовое использование</h2>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$heap = new SplMinHeap();
$heap->insert(5);
$heap->insert(10);
$heap->insert(1);
$heap->insert(100);

foreach ($heap as $element) {
	echo $element . "\n";
}
]]></script>

<pre>
<?php
$heap = new SplMinHeap();
$heap->insert(5);
$heap->insert(10);
$heap->insert(1);
$heap->insert(100);

foreach ($heap as $element) {
	echo $element . "\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.splminheap.php">Официальная документация</a></li>
	<li><a href="spl-heap">SplHeap</a></li>
	<li><a href="spl-max-heap">SplMaxHeap</a></li>
</ul>