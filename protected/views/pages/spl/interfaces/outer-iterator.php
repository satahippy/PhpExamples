<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'OuterIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Интерфейсы', 'url' => '/spl/interfaces/'),
	array('title' => 'OuterIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Интерфейс для обёрток итераторов.
</p>
<p>
	Большое количество итераторов реализуют этот интерфейс. Самый простой пример - <a href="../iterators/filter-iterator">FilterIterator</a>.
</p>

<h2>Пример реализации</h2>
<p>
	По большому счёту, каждая обёртка должна принимать в качестве аргумента некоторый итератор и пропускать все его методы через себя.
</p>
<p>
	Правда каждый итератор может себя вести по разному и это следует учитывать.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class PoliteArrayIterator implements OuterIterator
{
	protected $iterator;

	public function __construct(Iterator $iterator)
	{
		$this->iterator = $iterator;
	}

	public function getInnerIterator()
	{
		return $this->iterator;
	}

	public function current()
	{
		return $this->iterator->current() . ', please';
	}

	public function next()
	{
		$this->iterator->next();
	}

	public function key()
	{
		return $this->iterator->key();
	}

	public function valid()
	{
		return $this->iterator->valid();
	}

	public function rewind()
	{
		$this->iterator->rewind();
	}
}

$bar = new PoliteArrayIterator(new ArrayIterator(['soda', 'beer', 'vine', 'vodka']));
foreach ($bar as $drink) {
	echo $drink . "\n";
}
]]></script>

<pre>
<?php

class PoliteArrayIterator implements OuterIterator
{
	protected $iterator;

	public function __construct(Iterator $iterator)
	{
		$this->iterator = $iterator;
	}

	public function getInnerIterator()
	{
		return $this->iterator;
	}

	public function current()
	{
		return $this->iterator->current() . ', please';
	}

	public function next()
	{
		$this->iterator->next();
	}

	public function key()
	{
		return $this->iterator->key();
	}

	public function valid()
	{
		return $this->iterator->valid();
	}

	public function rewind()
	{
		$this->iterator->rewind();
	}
}

$bar = new PoliteArrayIterator(new ArrayIterator(['soda', 'beer', 'vine', 'vodka']));
foreach ($bar as $drink) {
	echo $drink . "\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.outeriterator.php">Официальная документация</a></li>
	<li><a href="https://blog.engineyard.com/2014/the-outer-iterator">Неплохая статья по OuterIterator и FilterIterator</a></li>
</ul>