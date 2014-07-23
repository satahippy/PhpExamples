<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'EmptyIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'EmptyIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Пустой итератор.
</p>
<p>
	Может понадобиться в том случае, если вы хотите вернуть итератор для неопределённой коллекции.
</p>
<p>
	По большому счёту бесполезная штука.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class ProductsStorage implements IteratorAggregate
{
	protected $products;

	public function getIterator()
	{
		if ($this->products === null) {
			return new EmptyIterator();
		} else {
			return new ArrayIterator($this->products);
		}
	}
}

$productsStorage = new ProductsStorage();
foreach ($productsStorage as $product => $count) {
	echo "$product($count)\n";
}
]]></script>

<pre>
<?php

class ProductsStorage implements IteratorAggregate
{
	protected $products;

	public function getIterator()
	{
		if ($this->products === null) {
			return new EmptyIterator();
		} else {
			return new ArrayIterator($this->products);
		}
	}
}

$productsStorage = new ProductsStorage();
foreach ($productsStorage as $product => $count) {
	echo "$product($count)\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.emptyiterator.php">Официальная документация</a></li>
</ul>