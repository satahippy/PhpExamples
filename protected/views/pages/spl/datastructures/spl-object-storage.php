<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'SplObjectStorage.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Структуры данных', 'url' => '/spl/datastructures/'),
	array('title' => 'SplObjectStorage')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Объединяет в себе две структуры хэш таблицу и множество. Т.е. структура может хранить как объект и ассоциированное с ним значение, так и просто объект.
</p>
<p>
	А также поддерживает всякие операции с множествами/хэш таблицами.
</p>
<ul>
	<li>Объединение</li>
	<li>Пересечение</li>
	<li>Вычитание</li>
</ul>

<h2>Когда использовать</h2>
<p>
	Когда надо хранить объекты и ассоциированные с ними значения или просто хранить объекты.
</p>

<h2>Сравнение с обычным массивом</h2>
<p>
	В принципе массив в php и есть по большому счёту хэш таблица. Вот только ключами массива могут быть только строки и числа.
	<code>SplObjectStorage</code> может использовать любые объекты в качестве ключей.
</p>
<p>
	<code>SplObjectStorage</code> немного производительней массива, но расходует больше памяти.
</p>

<h2>Базовое использование</h2>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class Object
{
	public $name;

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function __toString()
	{
		return $this->name;
	}

}

function printStorage($storage)
{
	foreach ($storage as $key => $val) {
		echo $val . ": " . $storage[$val] . "\n";
	}
}

$obj1 = new Object('obj1');
$obj2 = new Object('obj2');
$obj3 = new Object('obj3');

$storage = new SplObjectStorage();
$storage2 = new SplObjectStorage();

$storage->attach($obj1);

echo "contains";
var_dump($storage->contains($obj2));
$storage->attach($obj2);
var_dump($storage->contains($obj2));


$storage2->attach($obj1, 10);
$storage2->attach($obj3, 1000);

echo "union\n";
$storage->addAll($storage2);
printStorage($storage);
echo "\n";

echo "subtraction\n";
$storage->removeAll($storage2);
printStorage($storage);
echo "\n";

echo "intersect\n";
$storage->addAll($storage2);
$storage->removeAllExcept($storage2);
printStorage($storage);
]]></script>

<pre>
<?php

class Object
{
	public $name;

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function __toString()
	{
		return $this->name;
	}

}

function printStorage($storage)
{
	foreach ($storage as $key => $val) {
		echo $val . ": " . $storage[$val] . "\n";
	}
}

$obj1 = new Object('obj1');
$obj2 = new Object('obj2');
$obj3 = new Object('obj3');

$storage = new SplObjectStorage();
$storage2 = new SplObjectStorage();

$storage->attach($obj1);

echo "contains";
var_dump($storage->contains($obj2));
$storage->attach($obj2);
var_dump($storage->contains($obj2));


$storage2->attach($obj1, 10);
$storage2->attach($obj3, 1000);

echo "union\n";
$storage->addAll($storage2);
printStorage($storage);
echo "\n";

echo "subtraction\n";
$storage->removeAll($storage2);
printStorage($storage);
echo "\n";

echo "intersect\n";
$storage->addAll($storage2);
$storage->removeAllExcept($storage2);
printStorage($storage);
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.splobjectstorage.php">Официальная документация</a></li>
</ul>