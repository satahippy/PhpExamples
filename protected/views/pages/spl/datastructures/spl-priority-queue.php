<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Структуры данных.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Структуры данных', 'url' => '/spl/datastructures/'),
	array('title' => 'SplPriorityQueue')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Приоритетная очередь. Очень похожа на кучу, но не реализует <code>SplHeap</code>. Вместо этого использует кучу внутри себя.
</p>
<p>
	Т.е. <code>SplPriorityQueue</code> принимает в себя объект с его приоритетом. Объекты хранятся в виде кучи, объект с наивысшим приоритетом хранится на верху (как у <code>SplMaxHeap</code>). Так же как из кучи можно просто обойти всю кучу, либо вытащить объект с вершины.
</p>

<h2>Когда использовать</h2>
<p>
	Тогда, когда и <a href="spl-heap">SplHeap</a>, но сортировать на по какому то приоритету (или внешнему параметру).
</p>

<h2>Сравнение с обычным массивом</h2>
<p>
	Как и <a href="spl-heap">SplHeap</a> быстрее массива и расходует меньше памяти.
</p>

<h2>Базовое использование</h2>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class Man
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

function generateQueue()
{
	$queue = new SplPriorityQueue();

	$queue->insert(new Man('Homeless Man'), 1);
	$queue->insert(new Man('Boss'), 1000);
	$queue->insert(new Man('Sexy Girl'), 10);
	$queue->insert(new Man('Mike Tyson'), 9001);
	
	return $queue;
}

$waitingPeople = generateQueue();

// who is the most important man
echo "Most Important: ".$waitingPeople->extract()."\n";
// other people
foreach ($waitingPeople as $man) {
	echo $man . "\n";
}
]]></script>

<pre>
<?php
class Man
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

function generateQueue()
{
	$queue = new SplPriorityQueue();

	$queue->insert(new Man('Homeless Man'), 1);
	$queue->insert(new Man('Boss'), 1000);
	$queue->insert(new Man('Sexy Girl'), 10);
	$queue->insert(new Man('Mike Tyson'), 9001);
	
	return $queue;
}

$waitingPeople = generateQueue();

// who is the most important man
echo "Most Important: ".$waitingPeople->extract()."\n";
// other people
foreach ($waitingPeople as $man) {
	echo $man . "\n";
}
?>
</pre>

<h1><code>setExtractFlags</code></h1>
<p>
	Можно определить поведение извлечения элементов. Это относится и к простому перебору и к <code>extract()/top()/current()</code>.
</p>
<ul>
	<li><code>EXTR_DATA</code> - Извлекать данные</li>
	<li><code>EXTR_PRIORITY</code> - Извлекать приоритет</li>
	<li><code>EXTR_BOTH</code> - Извлекать данные + приоритет в виде массива</li>
</ul>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$waitingPeople = generateQueue();

$waitingPeople->setExtractFlags(SplPriorityQueue::EXTR_BOTH);
foreach ($waitingPeople as $item) {
	echo $item['data'] . ": " . $item['priority'] . "\n";
}
]]></script>
<pre>
<?php
$waitingPeople = generateQueue();

$waitingPeople->setExtractFlags(SplPriorityQueue::EXTR_BOTH);
foreach ($waitingPeople as $item) {
	echo $item['data'] . ": " . $item['priority'] . "\n";
}
?>
</pre>

<h1>Кастомный <code>compare</code></h1>
<p>
	Вы конечно же можете переопределить метод <code>compare</code>, для того чтобы определять какой приоритет выше.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class FairQueue extends SplPriorityQueue
{
	public function compare($priority1, $priority2)
	{
		return $priority2->getTimestamp() - $priority1->getTimestamp();
	}
}

$waitingPeople = new FairQueue();
$waitingPeople->setExtractFlags(SplPriorityQueue::EXTR_BOTH);

$waitingPeople->insert(new Man('Homeless Man'), new DateTime('2014-01-01 00:00:00'));
$waitingPeople->insert(new Man('Boss'), new DateTime('2014-03-01 12:00:00'));
$waitingPeople->insert(new Man('Sexy Girl'), new DateTime('2014-02-01 18:00:00'));
$waitingPeople->insert(new Man('Mike Tyson'), new DateTime('2014-03-01 12:01:00'));

foreach ($waitingPeople as $item) {
	echo $item['data'] . " waiting since " . $item['priority']->format('Y-m-d H:i') . "\n";
}
]]></script>
<pre>
<?php
class FairQueue extends SplPriorityQueue
{
	public function compare($priority1, $priority2)
	{
		return $priority2->getTimestamp() - $priority1->getTimestamp();
	}
}

$waitingPeople = new FairQueue();
$waitingPeople->setExtractFlags(SplPriorityQueue::EXTR_BOTH);

$waitingPeople->insert(new Man('Homeless Man'), new DateTime('2014-01-01 00:00:00'));
$waitingPeople->insert(new Man('Boss'), new DateTime('2014-03-01 12:00:00'));
$waitingPeople->insert(new Man('Sexy Girl'), new DateTime('2014-02-01 18:00:00'));
$waitingPeople->insert(new Man('Mike Tyson'), new DateTime('2014-03-01 12:01:00'));

foreach ($waitingPeople as $item) {
	echo $item['data'] . " waiting since " . $item['priority']->format('Y-m-d H:i') . "\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.splpriorityqueue.php">Официальная документация</a></li>
</ul>