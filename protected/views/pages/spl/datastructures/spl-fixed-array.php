<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Структуры данных.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Структуры данных', 'url' => '/spl/datastructures/'),
	array('title' => 'SplFixedArray')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Массив с фиксированной длинной. Настоящий массив, в стиле Java массивов. Индексы могут быть только целочисленные, только положительные и только в пределах длины.
</p>
<p>
	Конечно можно и увеличить его длину, но операция это затратная.
</p>

<h2>Когда использовать</h2>
<p>
	Когда заранее известо количество элементов в массиве.
</p>

<h2>Сравнение с обычным массивом</h2>
<p>
	Быстрее массива и потребляет меньше памяти. Всё логично)
</p>
<p>
	Большая часть функций для работы с массивами, с ним не может работать.
	<br/>
	Как выход из этого: можно использовать <code>toArray</code>.
</p>

<h2>Базовое использование</h2>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$arr = new SplFixedArray(5);
$arr[1] = 2;
$arr[2] = 3;

echo "size: " . $arr->getSize() . "\n";
echo "count: " . $arr->count() . "\n";

try {
	var_dump($arr["non-numeric"]);
} catch (RuntimeException $re) {
	echo "RuntimeException: " . $re->getMessage() . "\n";
}

try {
	var_dump($arr[-1]);
} catch (RuntimeException $re) {
	echo "RuntimeException: " . $re->getMessage() . "\n";
}

try {
	var_dump($arr[5]);
} catch (RuntimeException $re) {
	echo "RuntimeException: " . $re->getMessage() . "\n";
}

foreach ($arr as $el) {
	echo $el . "\n";
}
]]></script>

<pre>
<?php
$arr = new SplFixedArray(5);
$arr[1] = 2;
$arr[2] = 3;

echo "size: " . $arr->getSize() . "\n";
echo "count: " . $arr->count() . "\n";

try {
	var_dump($arr["non-numeric"]);
} catch (RuntimeException $re) {
	echo "RuntimeException: " . $re->getMessage() . "\n";
}

try {
	var_dump($arr[-1]);
} catch (RuntimeException $re) {
	echo "RuntimeException: " . $re->getMessage() . "\n";
}

try {
	var_dump($arr[5]);
} catch (RuntimeException $re) {
	echo "RuntimeException: " . $re->getMessage() . "\n";
}

foreach ($arr as $el) {
	echo $el . "\n";
}
?>
</pre>

<h2><code>fromArray</code>/<code>toArray</code></h2>
<p>
	Всегда можно провести конвертацию!
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$fixed = SplFixedArray::fromArray([1, 2, 3]);
$array = $fixed->toArray();

var_dump($fixed);
var_dump($array);
]]></script>
<pre>
<?php
$fixed = SplFixedArray::fromArray([1, 2, 3]);
$array = $fixed->toArray();

var_dump($fixed);
var_dump($array);
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.splfixedarray.php">Официальная документация</a></li>
</ul>