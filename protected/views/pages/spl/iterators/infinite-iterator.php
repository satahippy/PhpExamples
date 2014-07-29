<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'InfiniteIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'InfiniteIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Итератор обёртка. Делает итератор бесконечно итерируемым. Т.е. вызывает <code>rewind</code> в нужный момент.
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$algorithm = new InfiniteIterator(new ArrayIterator(['step 1', 'step 2', 'step 3']));

$i = 0;
foreach ($algorithm as $step) {
	$i++;
	if ($i == 5) {
		break;
	}
	echo "$step\n";
}
]]></script>

<pre>
<?php
$algorithm = new InfiniteIterator(new ArrayIterator(['step 1', 'step 2', 'step 3']));

$i = 0;
foreach ($algorithm as $step) {
	$i++;
	if ($i == 5) {
		break;
	}
	echo "$step\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.infiniteiterator.php">Официальная документация</a></li>
	<li><a href="../interfaces/outer-iterator">OuterIterator</a></li>
</ul>