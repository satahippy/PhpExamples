<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'NoRewindIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'NoRewindIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Не позволяет итератору возвратить в начало (<code>rewind</code>), т.е. итератор можно пройти только один раз.
</p>
<p>
	Сам по себе является декоратором, хоть и не реализует интерфейс
	<a href="../interfaces/outer-iterator">OuterIterator</a>.
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$consoles = new ArrayIterator(['PC', 'Xbox', 'PS', 'Wii']);

echo "--NoRewindIterator begin\n";
$consolesOnce = new NoRewindIterator($consoles);
foreach ($consolesOnce as $console) {
	echo "$console\n";
}

echo "\n--you can't do it twice\n";
foreach ($consolesOnce as $console) {
	echo "$console\n";
}

echo "\n--but you can iterate source iterator\n";
foreach ($consoles as $console) {
	echo "$console\n";
}
]]></script>

<pre>
<?php
$consoles = new ArrayIterator(['PC', 'Xbox', 'PS', 'Wii']);

echo "--NoRewindIterator begin\n";
$consolesOnce = new NoRewindIterator($consoles);
foreach ($consolesOnce as $console) {
	echo "$console\n";
}

echo "\n--you can't do it twice\n";
foreach ($consolesOnce as $console) {
	echo "$console\n";
}

echo "\n--but you can iterate source iterator\n";
foreach ($consoles as $console) {
	echo "$console\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.norewinditerator.php">Официальная документация</a></li>
</ul>