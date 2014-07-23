<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Итераторы.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы')
));
?>

<p>
	Очевидны они нужны для итерации некоторых структур данных.
</p>
<p>
	SPL предлагает довольно много итераторов. 
</p>
<ul>
	<li><a href="array-iterator">ArrayIterator</a></li>
	<li><a href="empty-iterator">EmptyIterator</a></li>
</ul>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/spl.iterators.php">Официальная документация</a></li>
	<li><a href="http://ru.wikipedia.org/wiki/Итератор">Итератор (wiki)</a></li>
</ul>