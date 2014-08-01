<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'IteratorIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'IteratorIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	С его помощью вы можете взять <a href="/built-in/traversable">Traversable</a></code> и сделать из него итератор.
</p>
<p>
	На самом деле не очень понятно, для чего эта штука может понадобиться, но от неё наследуется почти каждый класс итератора. Непонятно, потому что в принципе <code>Traversable</code> уже можно перебрать с помощью <code>foreach</code>. 
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$db = new PDO('sqlite:protected/test.sqlite');

// Traversable
echo '--just Traversable and foreach';
$stmt = $db->prepare('SELECT * FROM people');
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

foreach ($stmt as $item) {
	var_dump($item);
}

// IteratorIterator
echo '--IteratorIterator and all features of Iterator';
$stmt->execute();
$it = new IteratorIterator($stmt);

$it->rewind();
while ($it->valid()) {
	var_dump($it->current());
	$it->next();
}
]]></script>

<pre>
<?php
$db = new PDO('sqlite:protected/test.sqlite');

// Traversable
echo '--just Traversable and foreach';
$stmt = $db->prepare('SELECT * FROM people');
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

foreach ($stmt as $item) {
	var_dump($item);
}

// IteratorIterator
echo '--IteratorIterator and all features of Iterator';
$stmt->execute();
$it = new IteratorIterator($stmt);

$it->rewind();
while ($it->valid()) {
	var_dump($it->current());
	$it->next();
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.iteratoriterator.php">Официальная документация</a></li>
</ul>