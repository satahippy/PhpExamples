<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'SplQueue.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Структуры данных', 'url' => '/spl/datastructures/'),
	array('title' => 'SplQueue')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Коллекция, которая работает по принципу - первый вошёл, первый вышел.
</p>
<p>
	Как и <code>SplStack</code> это просто <code>SplDoublyLinkedList</code> с предустановленным режимом перебора -
	<code>IT_MODE_FIFO | IT_MODE_KEEP</code>.
	<br/>
	Т.е. перебираем с начала без удаления элементов.
</p>

<h2>Когда использовать</h2>
<p>
	Когда нужен последовательный доступ к элементам в режиме FIFO.
</p>

<h2>Сравнение с обычным массивом</h2>
<p>
	В отличии от <code>SplStack</code>, <code>SplQueue</code> выигрывает в производительности у массива, особенно при больших объёмах.
	<br/>
	Памяти, как и <code>SplStack</code>, тоже расходует меньше.
</p>

<h2>Базовое использование</h2>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$list = new SplQueue();

$list->enqueue('first');
$list->enqueue('second');
$list->enqueue('third');

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
$list = new SplQueue();

$list->enqueue('first');
$list->enqueue('second');
$list->enqueue('third');

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
	Хоть и <code>SplQueue</code> полностью позволяет работать с ним, как с
	<code>SplDoublyLinkedList</code>, не рекомендуется использовать методы не специфичные для оечереди. Чтобы не было путаницы.
</p>
<p>
	Хотя на самом деле, есть одно ограничение. Вы не можете выбрать направление итератора.
</p>
<p>
	Для удобства введены методы <code>enqueue</code> - добавляет элемент в очередь (как альтернатива <code>push</code>) и <code>dequeue</code> - выталкивает элемент из очереди (как альтернатива <code>shift</code>).
	<br/>
	По большому они введены, чтобы не было путаницы.
</p>

<h2>Ссылки:</h2>
<ul>
	<li>
		<a href="http://www.php.net/manual/ru/class.splqueue.php">Официальная документация</a>
	</li>
</ul>