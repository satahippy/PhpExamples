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
	<li><a href="filter-iterator">FilterIterator</a></li>
	<li><a href="callback-filter-iterator">CallbackFilterIterator</a></li>
	<li><a href="infinite-iterator">InfiniteIterator</a></li>
</ul>
<p>
	По мимо этого, можно реализовывать свои итераторы реализуя следующие интерфейсы:
</p>
<ul>
	<li><a href="/built-in/iterator">Iterator</a></li>
	<li><a href="/built-in/iterator-aggregate">IteratorAggregate</a></li>
	<li><a href="/spl/interfaces/outer-iterator">OuterIterator</a></li>
</ul>
<!-- TODO ссылки на SeekableIterator, RecursiveIterator -->

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/spl.iterators.php">Официальная документация</a></li>
	<li><a href="http://ru.wikipedia.org/wiki/Итератор">Итератор (wiki)</a></li>
</ul>