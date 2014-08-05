<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'AppendIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'AppendIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Всё просто: итератор который последовательно перебирает все итераторы.
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new AppendIterator();
$it->append(new ArrayIterator(['dog', 'cat', 'fish']));
$it->append(new ArrayIterator(['fly', 'spider']));

foreach ($it as $key => $val) {
	echo "$key({$it->getIteratorIndex()}): $val\n";
}
]]></script>

<pre>
<?php
$it = new AppendIterator();
$it->append(new ArrayIterator(['dog', 'cat', 'fish']));
$it->append(new ArrayIterator(['fly', 'spider']));

foreach ($it as $key => $val) {
	echo "$key({$it->getIteratorIndex()}): $val\n";
}
?>
</pre>
<p>
	При этом ключи берутся из внутренних итераторов. А индекс текущего итератора можно получить с помощью <code>getIteratorIndex</code>.
	<br/>
	По мимо этого доступ к текущему итератору можно получить с помощью <code>getInnerIterator</code>.
</p>

<h2>Список итераторов</h2>
<p>
	<code>AppendIterator</code> хранит все итераторы в <a href="array-iterator">ArrayIterator</a>, и он предоставляет к ним доступ по средством <code>getArrayIterator</code>
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
foreach ($it->getArrayIterator() as $key => $val) {
	echo "Iterator $key\n";
	foreach ($val as $k => $v) {
		echo "\t$k: $v\n";
	}
}
]]></script>

<pre>
<?php
foreach ($it->getArrayIterator() as $key => $val) {
	echo "Iterator $key\n";
	foreach ($val as $k => $v) {
		echo "\t$k: $v\n";
	}
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.appenditerator.php">Официальная документация</a></li>
</ul>