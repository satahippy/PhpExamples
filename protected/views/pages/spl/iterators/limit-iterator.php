<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'LimitIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'LimitIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Итератор обёртка. Ограничивает количество итераций.
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$consoles = new ArrayIterator(['PC', 'Xbox', 'PS', 'Wii']);

echo "--limit less than count\n";
$purchases = new LimitIterator($consoles, 0, 2);

foreach ($purchases as $purchase) {
	echo "$purchase\n";
}

echo "--limit more than count\n";
$purchases = new LimitIterator($consoles, 0, 10);

foreach ($purchases as $purchase) {
	echo "$purchase\n";
}

echo "--start from second item\n";
$purchases = new LimitIterator($consoles, 1);

foreach ($purchases as $purchase) {
	echo "$purchase\n";
}
]]></script>

<pre>
<?php
$consoles = new ArrayIterator(['PC', 'Xbox', 'PS', 'Wii']);

echo "--limit less than count\n";
$purchases = new LimitIterator($consoles, 0, 2);

foreach ($purchases as $purchase) {
	echo "$purchase\n";
}

echo "--limit more than count\n";
$purchases = new LimitIterator($consoles, 0, 10);

foreach ($purchases as $purchase) {
	echo "$purchase\n";
}

echo "--start from second item\n";
$purchases = new LimitIterator($consoles, 1);

foreach ($purchases as $purchase) {
	echo "$purchase\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.limititerator.php">Официальная документация</a></li>
	<li><a href="../interfaces/outer-iterator">OuterIterator</a></li>
</ul>