<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Структуры данных.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Структуры данных', 'url' => '/spl/datastructures/'),
	array('title' => 'SplMaxHeap')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Та же самая куча <code>SplHeap</code>, только с уже реализованным методом <code>compare</code>. Элементы располагаются таким образом, что самый большой остаётся на её вершине.
</p>
<p>
	Всё бы хорошо, но иногда непонято, как пойдёт это самое сравнение. Как будут сравниваться объекты?
</p>

<h2>Базовое использование</h2>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$heap = new SplMaxHeap();
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
$heap = new SplMaxHeap();
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
	<li><a href="http://www.php.net/manual/ru/class.splmaxheap.php">Официальная документация</a></li>
	<li>
		<a href="spl-heap">SplHeap</a>
	</li>
</ul>