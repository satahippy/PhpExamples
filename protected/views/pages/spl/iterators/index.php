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
	SPL предлагает довольно много итераторов и всяких примочек. 
</p>

<h3>Вспомогательные классы</h3>
<ul>
	<li><a href="/spl/interfaces/outer-iterator">OuterIterator</a></li>
	<li><a href="iterator-iterator">IteratorIterator</a></li>
</ul>

<h3>Итераторы</h3>
<ul>
	<li><a href="array-iterator">ArrayIterator</a></li>
	<li><a href="empty-iterator">EmptyIterator</a></li>
</ul>

<h3>Обёртки</h3>
<ul>
	<li><a href="filter-iterator">FilterIterator</a></li>
	<li><a href="callback-filter-iterator">CallbackFilterIterator</a></li>
	<li><a href="regex-iterator">RegexIterator</a></li>
	<li><a href="infinite-iterator">InfiniteIterator</a></li>
	<li><a href="limit-iterator">LimitIterator</a></li>
	<li><a href="no-rewind-iterator">NoRewindIterator</a></li>
	<li><a href="caching-iterator">CachingIterator</a></li>
	<li><a href="append-iterator">AppendIterator</a></li>
	<li><a href="multiple-iterator">MultipleIterator</a></li>
</ul>

<h3>Рекурсивные итераторы</h3>
<ul>
    <li><a href="recursive-iterator-iterator">RecursiveIteratorIterator</a></li>
    <li><a href="recursive-array-iterator">RecursiveArrayIterator</a></li>
    <li><a href="recursive-caching-iterator">RecursiveCachingIterator</a></li>
    <li><a href="recursive-filter-iterator">RecursiveFilterIterator</a></li>
    <li><a href="recursive-callback-filter-iterator">RecursiveCallbackFilterIterator</a></li>
</ul>

<!-- TODO ссылки на рекурсивный итераторы и на файловые итераторы -->

<p>
	По мимо этого, можно реализовывать свои итераторы реализуя следующие интерфейсы:
</p>
<ul>
	<li><a href="/built-in/iterator">Iterator</a></li>
	<li><a href="/built-in/iterator-aggregate">IteratorAggregate</a></li>
	<li><a href="/spl/interfaces/outer-iterator">OuterIterator</a></li>
	<li><a href="/spl/interfaces/recursive-iterator">RecursiveIterator</a></li>
	<li><a href="/spl/interfaces/seekable-iterator">SeekableIterator</a></li>
</ul>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/spl.iterators.php">Официальная документация</a></li>
	<li><a href="http://ru.wikipedia.org/wiki/Итератор">Итератор (wiki)</a></li>
</ul>