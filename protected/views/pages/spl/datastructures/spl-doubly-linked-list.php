<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Структуры данных.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Структуры данных', 'url' => '/spl/datastructures/'),
	array('title' => 'SplDoublyLinkedList')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<blockquote>SplDoublyLinkedList - двунаправленный список</blockquote>

<h2>Описание</h2>
<p>
	Название коллекции говорит само за себя.
	<br/>
	Можно вставлять элементы в конец, в начало.
	<br/>
	Можно брать элементы из начала, из конца.
	<br/>
	Ну и конечно его можно перебрать так, как вам захочется.
</p>

<h2>Когда использовать</h2>
<p>
	Когда нужен последовательный доступ к элементам
</p>

<h2>Сравнение с обычным массивом</h2>
<p>
	Смотри <a href="spl-stack">SplStack</a> и <a href="spl-queue">SplQueue</a>.
</p>

<h2>Базовое использование</h2>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$list = new SplDoublyLinkedList();

echo $list->isEmpty() ? "empty\n" : "not empty\n"; // список пустой?

$list->push('second'); // добавляем в конец 'second'
$list->unshift('first'); // добавляем в начало 'first'
$list->push('third'); // добавляем в конец 'third'

echo $list->count() . "\n"; // количество элементов в списке 

for ($list->rewind(); // указатель на начало (в контексте метода перебора)
     $list->valid(); // пока есть текущий элемент
     $list->next() // перемещаем указатель на следующий элемент
) {
	echo $list->current() . "\n"; // выводим текущий элемент
}
]]>
</script>

<pre>
<?php
$list = new SplDoublyLinkedList();

echo $list->isEmpty() ? "empty\n" : "not empty\n"; // список пустой?

$list->push('second'); // добавляем в конец 'second'
$list->unshift('first'); // добавляем в начало 'first'
$list->push('third'); // добавляем в конец 'third'

echo $list->count() . "\n"; // количество элементов в списке 

for ($list->rewind(); // указатель на начало (в контексте метода перебора)
     $list->valid(); // пока есть текущий элемент
     $list->next() // перемещаем указатель на следующий элемент
) {
	echo $list->current() . "\n"; // выводим текущий элемент
}
?>
</pre>

<h2>Направление перебора и его влияние</h2>
<p>
	Собственно режим перебора (направление) влияет только на функции, которые непосредственно участвуют в переборе: <code>next, prev, rewind</code>.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$list = new SplDoublyLinkedList();
$list->push('first');
$list->push('second');
$list->push('third');

// режим перебора "Очередь"
echo "FIFO (First In First Out):\n";
echo "top: " . $list->top() . "\n";
echo "bottom: " . $list->bottom() . "\n";
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);
for ($list->rewind(); $list->valid(); $list->next()) {
	echo $list->key() . ": " . $list->current() . "\n";
}
echo "\n";

// режим перебора "Стэк"
echo "LIFO (Last In First Out):\n";
echo "top: " . $list->top() . "\n";
echo "bottom: " . $list->bottom() . "\n";
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO);
for ($list->rewind(); $list->valid(); $list->next()) {
	echo $list->key() . ": " . $list->current() . "\n";
}
echo "\n";

// pop|shift
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);
echo "pop|shift(FIFO)\n";
echo "pop: " . $list->pop() . "\n";
echo "shift: " . $list->shift() . "\n\n";

$list = new SplDoublyLinkedList();
$list->push('first');
$list->push('second');
$list->push('third');
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO);
echo "pop|shift(LIFO)\n";
echo "pop: " . $list->pop() . "\n";
echo "shift: " . $list->shift() . "\n";
]]></script>
<pre>
<?php
$list = new SplDoublyLinkedList();
$list->push('first');
$list->push('second');
$list->push('third');

// режим перебора "Очередь"
echo "FIFO (First In First Out):\n";
echo "top: " . $list->top() . "\n";
echo "bottom: " . $list->bottom() . "\n";
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);
for ($list->rewind(); $list->valid(); $list->next()) {
	echo $list->key() . ": " . $list->current() . "\n";
}
echo "\n";

// режим перебора "Стэк"
echo "LIFO (Last In First Out):\n";
echo "top: " . $list->top() . "\n";
echo "bottom: " . $list->bottom() . "\n";
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO);
for ($list->rewind(); $list->valid(); $list->next()) {
	echo $list->key() . ": " . $list->current() . "\n";
}
echo "\n";

// pop|shift
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);
echo "pop|shift(FIFO)\n";
echo "pop: " . $list->pop() . "\n";
echo "shift: " . $list->shift() . "\n\n";

$list = new SplDoublyLinkedList();
$list->push('first');
$list->push('second');
$list->push('third');
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO);
echo "pop|shift(LIFO)\n";
echo "pop: " . $list->pop() . "\n";
echo "shift: " . $list->shift() . "\n";
?>
</pre>

<h2>Поведение перебора</h2>
<p>
	2 режима: элементы либо удаляются, либо остаются при обходе.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$list = new SplDoublyLinkedList();
$list->push('first');
$list->push('second');
$list->push('third');

// элементы остаются
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_KEEP);
for ($list->rewind(); $list->valid(); $list->next()) {
	;
}
echo $list->isEmpty() ? "empty\n" : "not empty\n";

// элементы удаляются
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_DELETE);
for ($list->rewind(); $list->valid(); $list->next()) {
	;
}
echo $list->isEmpty() ? "empty\n" : "not empty\n";
]]></script>
<pre>
<?php
$list = new SplDoublyLinkedList();
$list->push('first');
$list->push('second');
$list->push('third');

// элементы остаются
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_KEEP);
for ($list->rewind(); $list->valid(); $list->next()) {
	;
}
echo $list->isEmpty() ? "empty\n" : "not empty\n";

// элементы удаляются
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_DELETE);
for ($list->rewind(); $list->valid(); $list->next()) {
	;
}
echo $list->isEmpty() ? "empty\n" : "not empty\n";
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li>
		<a href="http://www.php.net/manual/ru/class.spldoublylinkedlist.php">Официальная документация</a>
	</li>
</ul>