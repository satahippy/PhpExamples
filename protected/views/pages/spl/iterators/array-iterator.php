<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'ArrayIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'ArrayIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Итератор для массивов.
</p>
<p>
	В основном используется вместе с
	<a href="/buiil-in/iterator-aggregate">IteratorAggregate</a>, когда объект хранит некоторые данные.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class ProductsStorage implements IteratorAggregate
{
	protected $products;

	public function __construct($products)
	{
		$this->products = $products;
	}

	public function getIterator()
	{
		return new ArrayIterator($this->products);
	}
}

$productsStorage = new ProductsStorage(['tomato' => 10, 'potato' => 3, 'carrot' => 100]);
foreach ($productsStorage as $product => $count) {
	echo "$product($count)\n";
}
]]></script>

<pre>
<?php

class ProductsStorage implements IteratorAggregate
{
	protected $products;

	public function __construct($products)
	{
		$this->products = $products;
	}

	public function getIterator()
	{
		return new ArrayIterator($this->products);
	}
}

$productsStorage = new ProductsStorage(['tomato' => 10, 'potato' => 3, 'carrot' => 100]);
foreach ($productsStorage as $product => $count) {
	echo "$product($count)\n";
}
?>
</pre>
<p>
	Здесь неявно используется итератор, возвращаемый методом <code>ArrayIterator</code>.
</p>

<p>
	По мимо этого, <code>ArrayIterator</code> потребляет меньше памяти, чем обычный перебор массива.
</p>

<h2>Дополнительные возможности</h2>
<p>
	Под этим в основном понимается возможность сортировки массива, используемого итератором.
</p>
<ul>
	<li><code>asort</code> - сортировка по значениям</li>
	<li><code>ksort</code> - сортировка по ключам</li>
	<li><code>natsort</code> - натуральная сортировка</li>
	<li><code>natcasesort</code> - натуральная сортировка с учётом регистра</li>
	<li><code>uasort</code> - пользовательская сортировка по значениям</li>
	<li><code>uksort </code> - пользовательская сортировка по ключам</li>
</ul>
<p>
	При этом исходный массив не изменится.
</p>
<p>
	На самом деле, это относится ко всем методам, которые что то меняют (<code>offsetSet</code>,
	<code>offsetUnset</code>, <code>append</code>).
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$arr = ['a' => 'first', 'b' => 'second', 'd' => 'third', 'c' => 'aaa!!! what?'];

$iterator = new ArrayIterator($arr);
$iterator->ksort();
$iterator->append('asdsad');

foreach ($iterator as $key => $val) {
	echo $key . ': ' . $val . "\n";
}

var_dump($arr);
]]></script>

<pre>
<?php
$arr = ['a' => 'first', 'b' => 'second', 'd' => 'third', 'c' => 'aaa!!! what?'];

$iterator = new ArrayIterator($arr);
$iterator->ksort();
$iterator->append('asdsad');

foreach ($iterator as $key => $val) {
	echo $key . ': ' . $val . "\n";
}

var_dump($arr);
?>
</pre>

<h2>Флаги</h2>
<p>
	С помощью них можно определить некоторые аспекты поведения
	<code>ArrayIterator</code>. Они либо передаются при создании, либо методом <code>setFlags</code>.
</p>
<ul>
	<li><code>ARRAY_AS_PROPS</code> - при его указании, данные будут доступны как свойства</li>
	<li><code>STD_PROP_LIST</code> - довольно мистический флаг. С помощью него определяется что возвращать в некоторых случаях (таких как <code>var_dump</code>)</li>
</ul>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$arr = ['a' => 'first', 'b' => 'second', 'd' => 'third', 'c' => 'aaa!!! what?'];

// standard behavior
$iterator = new ArrayIterator($arr);
// we can do it, but it's not get into data set
$iterator->test = 'sadsad';
// there's no property 'a'
//echo $iterator->a."\n";
// there's no 'test' index
//echo $iterator->offsetGet('test')."\n";

// flag ARRAY_AS_PROPS
$iterator = new ArrayIterator($arr, ArrayIterator::ARRAY_AS_PROPS);
// add data with index 'test' and value 'test value'
$iterator->test = 'test value';
// access to data with index 'a' in property style
echo $iterator->a . "\n";
// don't believe that we set data with index 'test'? 
echo $iterator->offsetGet('test') . "\n";
]]></script>

<pre>
<?php
$arr = ['a' => 'first', 'b' => 'second', 'd' => 'third', 'c' => 'aaa!!! what?'];

// standard behavior
$iterator = new ArrayIterator($arr);
// we can do it, but it's not get into data set
$iterator->test = 'sadsad';
// there's no property 'a'
//echo $iterator->a."\n";
// there's no 'test' index
//echo $iterator->offsetGet('test')."\n";

// flag ARRAY_AS_PROPS
$iterator = new ArrayIterator($arr, ArrayIterator::ARRAY_AS_PROPS);
// add data with index 'test' and value 'test value'
$iterator->test = 'test value';
// access to data with index 'a' in property style
echo $iterator->a . "\n";
// don't believe that we set data with index 'test'? 
echo $iterator->offsetGet('test') . "\n";
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.arrayiterator.php">Официальная документация</a></li>
	<li><a href="http://stackoverflow.com/a/16619183/3822548">Флаги ArrayIterator/ArrayObject</a></li>
</ul>