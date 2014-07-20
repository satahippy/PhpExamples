<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'IteratorAggregate.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Встроенные классы и интерфейсы', 'url' => '/built-in/'),
	array('title' => 'IteratorAggregate')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Интерфейс для создания внешнего итератора.
</p>
<p>
	В принципе исполняет ту же функцию, что и <a href="iterator">Iterator</a>, только использует внешний итератор.
</p>
<p>
	Т.е. такой объект вы можете использовать в <code>foreach</code> или использовать итератор напрямую.
</p>

<h2>Пример</h2>
<p>
	Собственно тут у нас будет список каких то настроек объекта, которые можно будет перебрать.
	Можно было бы ещё реализовать сеттеры и геттеры, для этой цели.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class TestObject implements IteratorAggregate
{
	protected $properties;

	public function __construct($properties = [])
	{
		$this->properties = $properties;
		$this->properties['internal'] = 'this is internal property';
	}

	public function getIterator()
	{
		return new ArrayIterator($this->properties);
	}
}

$test = new TestObject(['first' => 'i am first', 'second' => 'i am second']);
foreach($test as $key => $val) {
	echo $key . ': ' . $val . "\n";
}
]]></script>
<pre>
<?php

class TestObject implements IteratorAggregate
{
	protected $properties;

	public function __construct($properties = [])
	{
		$this->properties = $properties;
		$this->properties['internal'] = 'this is internal property';
	}

	public function getIterator()
	{
		return new ArrayIterator($this->properties);
	}
}

$test = new TestObject(['first' => 'i am first', 'second' => 'i am second']);
foreach($test as $key => $val) {
	echo $key . ': ' . $val . "\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.iteratoraggregate.php">Официальная документация</a></li>
</ul>