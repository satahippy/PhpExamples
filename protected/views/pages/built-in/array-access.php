<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'ArrayAccess.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Встроенные классы и интерфейсы', 'url' => '/built-in/'),
	array('title' => 'ArrayAccess')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Интерфейс для объектов, которые предоставляют доступ к своим данным, в стиле массивов.
</p>

<h2>Пример</h2>
<p>
	Стандартный пример реализации
	<code>ArrayAccess</code>. Есть объект, который хранит некоторые данные (атрибуты), доступ к которым будет происходить как с помощью getter'ов, setter'ов, так и в стиле массива.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class ObjectWithAttributes implements ArrayAccess
{
	protected $attributes = [];

	public function __get($key)
	{
		return $this->attributes[$key];
	}

	public function __set($key, $value)
	{
		$this->attributes[$key] = $value;
	}

	public function __isset($key)
	{
		return isset($this->attributes[$key]);
	}

	public function __unset($key)
	{
		unset($this->attributes[$key]);
	}

	public function offsetSet($offset, $value)
	{
		if (is_null($offset)) {
			$this->attributes[] = $value;
		} else {
			$this->attributes[$offset] = $value;
		}
	}

	public function offsetExists($offset)
	{
		return isset($this->attributes[$offset]);
	}

	public function offsetUnset($offset)
	{
		if ($this->offsetExists($offset)) {
			unset($this->attributes[$offset]);
		}
	}

	public function offsetGet($offset)
	{
		return $this->offsetExists($offset) ? $this->attributes[$offset] : null;
	}
}

$object = new ObjectWithAttributes();

// we can set attributes with setter
$object->attr1 = 'attribute 1';
// or with ArrayAccess functional
$object['attr2'] = 'attribute 2';

// and we can get attributes with getter
echo $object->attr2 . "\n";
// or with ArrayAccess functional 
echo $object['attr1'] . "\n";
]]></script>

<pre>
<?php

class ObjectWithAttributes implements ArrayAccess
{
	protected $attributes = [];

	public function __get($key)
	{
		return $this->attributes[$key];
	}

	public function __set($key, $value)
	{
		$this->attributes[$key] = $value;
	}

	public function __isset($key)
	{
		return isset($this->attributes[$key]);
	}

	public function __unset($key)
	{
		unset($this->attributes[$key]);
	}

	public function offsetSet($offset, $value)
	{
		if (is_null($offset)) {
			$this->attributes[] = $value;
		} else {
			$this->attributes[$offset] = $value;
		}
	}

	public function offsetExists($offset)
	{
		return isset($this->attributes[$offset]);
	}

	public function offsetUnset($offset)
	{
		if ($this->offsetExists($offset)) {
			unset($this->attributes[$offset]);
		}
	}

	public function offsetGet($offset)
	{
		return $this->offsetExists($offset) ? $this->attributes[$offset] : null;
	}
}

$object = new ObjectWithAttributes();

// we can set attributes with setter
$object->attr1 = 'attribute 1';
// or with ArrayAccess functional
$object['attr2'] = 'attribute 2';

// and we can get attributes with getter
echo $object->attr2 . "\n";
// or with ArrayAccess functional 
echo $object['attr1'] . "\n";

?>
</pre>

<h2>Совместимость с массивами</h2>

<p>
	По большому счёту её нет. Например функция <code>array_key_exists</code> не будет вызывать <code>offsetExists</code>. 
</p>
<p>
	Type hinting тоже не будет работать. Т.е. если вы ожидаете массив, как аргумент функции, то <code>ArrayAccess</code> не пройдёт.
	<br/>
	Обратное тоже не работает, т.е. если вы ожидаете <code>ArrayAccess</code>, то простой массив не подойдёт.
</p>
<p>
	По мимо прочего, индексы у <code>ArrayAccess</code> не ограничены только <code>string</code> или <code>int</code>, как это работает у массивов.
	<br/>
	В данном случае <code>ArrayAccess</code> работает как <a href="/spl/datastructures/spl-object-storage">SplObjectStorage</a>.
</p>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.arrayaccess.php">Официальная документация</a></li>
</ul>