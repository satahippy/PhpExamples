<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Структуры данных.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Структуры данных')
));
?>

<p>
	В чём профит? Их 2: 
</p>
<ul>
	<li>Потенциально большая производительность с большими объёмами данных</li>
	<li>Чистота кода</li>
</ul>

<p>
	Это конечно не полный список коллекций, который есть в Java. Но это лучше, чем совсем ничего!
</p>
<ul>
	<li><a href="spl-doubly-linked-list">SplDoublyLinkedList</a></li>
	<li><a href="spl-stack">SplStack</a></li>
</ul>

<h2>Ссылки:</h2>
<ul>
	<li>
		<a href="http://www.php.net/manual/ru/spl.datastructures.php">Официальная документация</a> 
	</li>
</ul>