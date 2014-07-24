<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Iterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Встроенные классы и интерфейсы', 'url' => '/built-in/'),
	array('title' => 'Iterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Интерфейс для всех итераторов. No more...
</p>

<h2>Варианты перебора</h2>
<p>
	Для того, чтобы избежать простых реализаций итераторов, здесь и далее будут приводиться примеры с использованием итератора
	<a href="/spl/iterators/array-iterator">ArrayIterator</a>.
</p>
<p>
	Можно использовать как классический подход:
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$iterator = new ArrayIterator(['first', 'second', 'last']);
$iterator->rewind();
while ($iterator->valid()) {
	echo $iterator->key() . ': ' . $iterator->current() . "\n";
	$iterator->next();
}
]]></script>
<pre>
<?php
$iterator = new ArrayIterator(['first', 'second', 'last']);
$iterator->rewind();
while ($iterator->valid()) {
	echo $iterator->key() . ': ' . $iterator->current() . "\n";
	$iterator->next();
}
?>
</pre>
<p>
	Так и с помощью <code>foreach</code>:
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
foreach ($iterator as $key => $val) {
	echo $key . ': ' . $val . "\n";
}
]]></script>
<pre>
<?php
foreach ($iterator as $key => $val) {
	echo $key . ': ' . $val . "\n";
}
?>
</pre>

<h2>Как работает итератор</h2>
<p>
	Данный пример взят из официальной документации. Он показывает, в какой момент
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class myIterator implements Iterator
{
	private $position = 0;
	private $array = array(
		"firstelement",
		"secondelement",
		"lastelement",
	);

	public function __construct()
	{
		$this->position = 0;
	}

	function rewind()
	{
		var_dump(__METHOD__);
		$this->position = 0;
	}

	function current()
	{
		var_dump(__METHOD__);
		return $this->array[$this->position];
	}

	function key()
	{
		var_dump(__METHOD__);
		return $this->position;
	}

	function next()
	{
		var_dump(__METHOD__);
		++$this->position;
	}

	function valid()
	{
		var_dump(__METHOD__);
		return isset($this->array[$this->position]);
	}
}

$it = new myIterator;

foreach ($it as $key => $value) {
	var_dump($key, $value);
	echo "\n";
}
]]></script>
<pre>
<?php

class myIterator implements Iterator
{
	private $position = 0;
	private $array = array(
		"firstelement",
		"secondelement",
		"lastelement",
	);

	public function __construct()
	{
		$this->position = 0;
	}

	function rewind()
	{
		var_dump(__METHOD__);
		$this->position = 0;
	}

	function current()
	{
		var_dump(__METHOD__);
		return $this->array[$this->position];
	}

	function key()
	{
		var_dump(__METHOD__);
		return $this->position;
	}

	function next()
	{
		var_dump(__METHOD__);
		++$this->position;
	}

	function valid()
	{
		var_dump(__METHOD__);
		return isset($this->array[$this->position]);
	}
}

$it = new myIterator;

foreach ($it as $key => $value) {
	var_dump($key, $value);
	echo "\n";
}
?>
</pre>

<h2>Реализация</h2>
<p>
	На примере покажем реализацию
	<code>Iterator</code>. Будем делать итератор, который рандомно перебирает элементы (<code>ArrayRandomIterator</code>).
</p>
<p>
	Это шуточный пример и его ни в коем случае нельзя использовать в реальных приложениях. Есть гораздо лучше способы рандомно перебрать массив.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class ArrayRandomIterator implements Iterator
{
	protected $array;

	protected $used = [];
	protected $currentKey;

	public function __construct($array)
	{
		$this->array = $array;
	}

	public function current()
	{
		return $this->array[$this->currentKey];
	}

	public function next()
	{
		$maxIndex = count($this->array) - count($this->used) - 1;
		if ($maxIndex < 0) {
			return;
		}
		$index = mt_rand(0, $maxIndex);

		for ($i = 0; $i <= $index; $i++) {
			if (in_array($i, $this->used)) {
				$index++;
			}
		}

		$this->used[] = $index;
		$this->currentKey = $index;
	}

	public function key()
	{
		return $this->currentKey;
	}

	public function valid()
	{
		return count($this->used) < count($this->array);
	}

	public function rewind()
	{
		$this->used = [];
		$this->next();
	}
}

$iterator = new ArrayRandomIterator(['Jennifer Lawrence', 'Tara Reid', 'Lindsay Lohan', 'Беркова']);
foreach ($iterator as $key => $actor) {
	echo $key . ': ' . $actor . "\n";
}
]]></script>
<pre>
<?php

class ArrayRandomIterator implements Iterator
{
	protected $array;

	protected $used = [];
	protected $currentKey;

	public function __construct($array)
	{
		$this->array = $array;
	}

	public function current()
	{
		return $this->array[$this->currentKey];
	}

	public function next()
	{
		$maxIndex = count($this->array) - count($this->used) - 1;
		if ($maxIndex < 0) {
			return;
		}
		$index = mt_rand(0, $maxIndex);

		for ($i = 0; $i <= $index; $i++) {
			if (in_array($i, $this->used)) {
				$index++;
			}
		}

		$this->used[] = $index;
		$this->currentKey = $index;
	}

	public function key()
	{
		return $this->currentKey;
	}

	public function valid()
	{
		return count($this->used) < count($this->array);
	}

	public function rewind()
	{
		$this->used = [];
		$this->next();
	}
}

$iterator = new ArrayRandomIterator(['Jennifer Lawrence', 'Tara Reid', 'Lindsay Lohan', 'Беркова']);
foreach ($iterator as $key => $actor) {
	echo $key . ': ' . $actor . "\n";
}

?>
</pre>

<h2>Где могут быть использованы итераторы?</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.iterator.php#96691">Для обхода результата запросов</a> и
		<a href="http://php.net/manual/ru/class.iterator.php#101381">другой вариант</a></li>
	<li>Для обхода строк в CSV/XML файле</li>
	<li>Для обхода символов в строке</li>
	<li>Для обхода слов из входного потока</li>
	<li>Для обхода результата <code>xpath</code></li>
	<li>Для обхода результата <code>regexp</code></li>
	<li>Для обхода файлов в папке</li>
</ul>

<h2>Ссылки:</h2>
<ul>
	<li>
		<a href="http://ru.wikipedia.org/wiki/%D0%98%D1%82%D0%B5%D1%80%D0%B0%D1%82%D0%BE%D1%80">Что такое Итератор (wiki)</a>
	</li>
	<li><a href="http://php.net/manual/ru/class.iterator.php">Официальная документация</a></li>
</ul>