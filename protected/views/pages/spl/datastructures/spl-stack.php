<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Структуры данных.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Структуры данных', 'url' => '/spl/datastructures/'),
	array('title' => 'SplStack')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Коллекция, которая работает по принципу - последний вошёл, первый вышел.
</p>
<p>
	На самом деле это просто <code>SplDoublyLinkedList</code> с предустановленным режимом перебора -
	<code>IT_MODE_LIFO | IT_MODE_KEEP</code>.
	<br/>
	Т.е. перебираем с конца без удаления элементов.
</p>

<h2>Базовое использование</h2>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$list = new SplStack();

$list->push('first');
$list->push('second');
$list->push('third');

// you can iterate in traditional syntax
for ($list->rewind(); $list->valid(); $list->next()) {
	echo $list->current() . "\n";
}
echo "\n";

// and with foreach
foreach ($list as $element) {
	echo $element . "\n";
}
echo "\n";

echo "top: " . $list->top() . "\n";
echo "bottom: " . $list->bottom() . "\n\n";

echo $list->count() . "\n";
$list->pop();
echo $list->count() . "\n";
]]></script>

<pre>
<?php
$list = new SplStack();

$list->push('first');
$list->push('second');
$list->push('third');

// you can iterate in traditional syntax
for ($list->rewind(); $list->valid(); $list->next()) {
	echo $list->current() . "\n";
}
echo "\n";

// and with foreach
foreach ($list as $element) {
	echo $element . "\n";
}
echo "\n";

echo "top: " . $list->top() . "\n";
echo "bottom: " . $list->bottom() . "\n\n";

echo $list->count() . "\n";
$list->pop();
echo $list->count() . "\n";
?>
</pre>

<h2>Рекомендации</h2>

<p>
	Хоть и <code>SplStack</code> полностью позволяет работать с ним, как с
	<code>SplDoublyLinkedList</code>, не рекомендуется использовать методы не специфичные для стэка. Чтобы не было путаницы.
</p>
<p>
	Т.е. для доступа к элементам используйте только итератор и методы <code>push</code>, <code>pop</code>.
</p>
<p>
	Хотя на самом деле, есть одно ограничение. Вы не можете выбрать направление итератора.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$list = new SplStack();

// you can use all methods from SplDoublyLinkedList
$list->push('first');
$list->push('second');
$list->push('third');
$list->unshift('what?');
echo "shift: " . $list->shift() . "\n\n";

// you can set another iterator mode. NOT THE DIRECTION!!!
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_DELETE | SplDoublyLinkedList::IT_MODE_LIFO);
foreach ($list as $element) {
	echo $element . "\n";
}
echo "count: " . $list->count();
]]></script>
<pre>
<?php
$list = new SplStack();

// you can use all methods from SplDoublyLinkedList
$list->push('first');
$list->push('second');
$list->push('third');
$list->unshift('what?');
echo "shift: " . $list->shift() . "\n\n";

// you can set another iterator mode. NOT THE DIRECTION!!!
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_DELETE | SplDoublyLinkedList::IT_MODE_LIFO);
foreach ($list as $element) {
	echo $element . "\n";
}
echo "count: " . $list->count();
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li>
		<a href="http://www.php.net/manual/ru/class.splstack.php">Официальная документация</a>
	</li>
</ul>