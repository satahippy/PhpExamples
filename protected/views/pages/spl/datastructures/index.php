<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Структуры данных.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Структуры данных')
));
?>

<p>
	Прежде всего это альтернатива обычным массивам. Дело в том, что в PHP, массивы не совсем традиционны. Скорее это Хэш таблицы.
</p>
<p>
	Обычные массивы подходят для большей части задач. Но иногда можно получить профит и от других структур данных.
</p>
<p>
	В чём профит? Их 2: 
</p>
<ul>
	<li>Потенциально большая производительность</li>
	<li>Потенциально меньшее потребление памяти</li>
	<li>Чистота кода</li>
</ul>

<p>
	Это конечно не полный список коллекций, который есть в Java. Но это лучше, чем совсем ничего!
</p>
<ul>
	<li><a href="spl-doubly-linked-list">SplDoublyLinkedList</a></li>
	<li><a href="spl-stack">SplStack</a></li>
	<li><a href="spl-queue">SplQueue</a></li>
	<li><a href="spl-heap">SplHeap</a></li>
	<li><a href="spl-max-heap">SplMaxHeap</a></li>
	<li><a href="spl-min-heap">SplMinHeap</a></li>
	<li><a href="spl-priority-queue">SplPriorityQueue</a></li>
</ul>

<h2>Ссылки:</h2>
<ul>
	<li>
		<a href="http://www.php.net/manual/ru/spl.datastructures.php">Официальная документация</a>
	</li>
	<li>
		<a href="http://matthewturland.com/2010/05/20/new-spl-features-in-php-5-3/">Отличная статья о SPL структурах данных</a>. Там же есть сравнение производительности с обычными массивами.
	</li>
</ul>