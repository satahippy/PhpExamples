<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Интерфейсы.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Интерфейсы')
));
?>

<p>
	Некоторые интерфейсы, которые определяет SPL.
</p>
<ul>
	<li><a href="outer-iterator">OuterIterator</a></li>
</ul>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/spl.interfaces.php">Официальная документация</a></li>
	<li><a href="/built-in/">Встроенные классы и интерфейсы</a></li>
</ul>