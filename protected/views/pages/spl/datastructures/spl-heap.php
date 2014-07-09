<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Структуры данных.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Структуры данных', 'url' => '/spl/datastructures/'),
	array('title' => 'SplHeap')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Структура данных типа "куча". В двух словах, предоставляет доступ к элементам в порядке какой то сортировки. При вставке элемента рассчитывается его положение исходя из функции сравнения.
</p>

<h2>Когда использовать</h2>
<p>
	Когда нужен последовательный доступ к элементам в порядке некоторой сортировки.
</p>

<h2>Сравнение с обычным массивом</h2>
<p>
	Гораздо производительнее массива и меньше расход памяти.
	<br/>
	Однако, если мы заранее можем укомплектовать массив и затем отсортировать его, то разница может быть незаметной. А в некоторых случаях массив может обойти по производительности кучу.
</p>

<h2>Базовое использование</h2>
<p>
	Для использования <code>SplHeap</code>, надо реализовать его абстрактный метод
	<code>compare</code>, который как раз занимается сравнением.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class Man
{
	public $name;
	public $age;

	public function __construct($name, $age)
	{
		$this->name = $name;
		$this->age = $age;
	}

	public function __toString()
	{
		return $this->name . ": " . $this->age;
	}
}

class UnnecessaryPeopleHeap extends SplHeap
{
	protected function compare($value1, $value2)
	{
		return $value1->age - $value2->age;
	}
}

$unnecessaryPeople = new UnnecessaryPeopleHeap();
// insert in the right place
$unnecessaryPeople->insert(new Man('Strong Guy', 45));
$unnecessaryPeople->insert(new Man('Old Boby', 85));
$unnecessaryPeople->insert(new Man('Fucken Hot Catherine', 23));
$unnecessaryPeople->insert(new Man('Little Sucker', 5));
$unnecessaryPeople->insert(new Man('Mature Daisy', 30));

// just iterate "sorted" heap
foreach ($unnecessaryPeople as $man) {
	echo $man . "\n";
}
]]></script>

<pre>
<?php
class Man
{
	public $name;
	public $age;

	public function __construct($name, $age)
	{
		$this->name = $name;
		$this->age = $age;
	}

	public function __toString()
	{
		return $this->name . ": " . $this->age;
	}
}

class UnnecessaryPeopleHeap extends SplHeap
{
	protected function compare($value1, $value2)
	{
		return $value1->age - $value2->age;
	}
}

$unnecessaryPeople = new UnnecessaryPeopleHeap();
// insert in the right place
$unnecessaryPeople->insert(new Man('Strong Guy', 45));
$unnecessaryPeople->insert(new Man('Old Boby', 85));
$unnecessaryPeople->insert(new Man('Fucken Hot Catherine', 23));
$unnecessaryPeople->insert(new Man('Little Sucker', 5));
$unnecessaryPeople->insert(new Man('Mature Daisy', 30));

// just iterate "sorted" heap
foreach ($unnecessaryPeople as $man) {
	echo $man . "\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://www.php.net/manual/ru/class.splheap.php">Официальная документация</a></li>
	<li>
		<a href="http://ru.wikipedia.org/wiki/%D0%9A%D1%83%D1%87%D0%B0_(%D1%81%D1%82%D1%80%D1%83%D0%BA%D1%82%D1%83%D1%80%D0%B0_%D0%B4%D0%B0%D0%BD%D0%BD%D1%8B%D1%85)">Куча (структура данных)</a>
	</li>
</ul>