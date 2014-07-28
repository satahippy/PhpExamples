<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'FilterIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'FilterIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Декоратор для итераторов. Позволяет отбросить (а точнее пропустить) неугодные значения.
</p>
<p>
	Это абстрактный класс, для того, чтобы его использовать надо унаследоваться от него и реализовать метод
	<code>accept</code>.
</p>
<p>
	Как альтернативу можно рассмотреть <a href="callback-filter-iterator">CallbackFilterIterator</a>.
</p>

<h2>Базовое использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class BlackListFilterIterator extends FilterIterator
{
	protected $blackList;

	public function __construct(Iterator $iterator, array $blackList = [])
	{
		parent::__construct($iterator);
		$this->blackList = $blackList;
	}

	public function accept()
	{
		if (in_array($this->getInnerIterator()->current(), $this->blackList)) {
			return false;
		}
		return true;
	}
}

$usersIt = new BlackListFilterIterator(new ArrayIterator(['sata', 'luka', 'mafia', 'rust']), ['luka', 'mafia']);
foreach ($usersIt as $user) {
	echo "$user\n";
}
]]></script>

<pre>
<?php

class BlackListFilterIterator extends FilterIterator
{
	protected $blackList;

	public function __construct(Iterator $iterator, array $blackList = [])
	{
		parent::__construct($iterator);
		$this->blackList = $blackList;
	}

	public function accept()
	{
		if (in_array($this->getInnerIterator()->current(), $this->blackList)) {
			return false;
		}
		return true;
	}
}

$usersIt = new BlackListFilterIterator(new ArrayIterator(['sata', 'luka', 'mafia', 'rust']), ['luka', 'mafia']);
foreach ($usersIt as $user) {
	echo "$user\n";
}
?>
</pre>

<h2>Как работает <code>FilterIterator</code>? Последовательность вызовов</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class TestIterator extends ArrayIterator
{
	function rewind()
	{
		echo "--itertor rewind\n";
		parent::rewind();
	}

	function current()
	{
		echo "--itertor current\n";
		return parent::current();
	}

	function key()
	{
		echo "--itertor key\n";
		return parent::key();
	}

	function next()
	{
		echo "--itertor next\n";
		parent::next();
	}

	function valid()
	{
		echo "--itertor valid\n";
		return parent::valid();
	}
}

class TestFilterIterator extends FilterIterator
{
	private $i;

	function rewind()
	{
		echo "--filter rewind\n";
		parent::rewind();
	}

	function current()
	{
		echo "--filter current\n";
		return parent::current();
	}

	function key()
	{
		echo "--filter key\n";
		return parent::key();
	}

	function next()
	{
		echo "--filter next\n";
		parent::next();
	}

	function valid()
	{
		echo "--filter valid\n";
		return parent::valid();
	}

	public function accept()
	{
		echo "--filter accept\n";
		return $this->i++ % 2;
	}
}

$it = new TestFilterIterator(new TestIterator(['one', 'two', 'three', 'four']));
foreach ($it as $el) {
	echo "$el\n";
}
]]></script>

<pre>
<?php

class TestIterator extends ArrayIterator
{
	function rewind()
	{
		echo "--itertor rewind\n";
		parent::rewind();
	}

	function current()
	{
		echo "--itertor current\n";
		return parent::current();
	}

	function key()
	{
		echo "--itertor key\n";
		return parent::key();
	}

	function next()
	{
		echo "--itertor next\n";
		parent::next();
	}

	function valid()
	{
		echo "--itertor valid\n";
		return parent::valid();
	}
}

class TestFilterIterator extends FilterIterator
{
	private $i;

	function rewind()
	{
		echo "--filter rewind\n";
		parent::rewind();
	}

	function current()
	{
		echo "--filter current\n";
		return parent::current();
	}

	function key()
	{
		echo "--filter key\n";
		return parent::key();
	}

	function next()
	{
		echo "--filter next\n";
		parent::next();
	}

	function valid()
	{
		echo "--filter valid\n";
		return parent::valid();
	}

	public function accept()
	{
		echo "--filter accept\n";
		return $this->i++ % 2;
	}
}

$it = new TestFilterIterator(new TestIterator(['one', 'two', 'three', 'four']));
foreach ($it as $el) {
	echo "$el\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.filteriterator.php">Официальная документация</a></li>
	<li><a href="../interfaces/outer-iterator">OuterIterator</a></li>
	<li><a href="https://blog.engineyard.com/2014/the-outer-iterator">Неплохая статья по OuterIterator и FilterIterator</a></li>
</ul>