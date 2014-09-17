<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'SPL.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL')
));
?>
<blockquote>SPL - Standard PHP Library, Стандартная Библиотека PHP.</blockquote>
<p>
	Кто не знает SPL? А кто его реально использует?
</p>
<p>
	Собственно тут будут примеры использования SPL. Вообще её (библиотеку) делят на 7 частей: 
</p>
<ul>
	<li><a href="datastructures/">Структуры данных</a></li>
	<li><a href="iterators/">Итераторы</a></li>
	<li><a href="interfaces/">Интерфейсы</a></li>
    <li><a href="files/">Работа с файлами</a></li>
    <li><a href="functions/">Функции</a></li>
    <li><a href="other/">Разное</a></li>
</ul>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://www.php.net/manual/ru/spl.datastructures.php">SPL</a> - официальная документация</li>
	<li><a href="https://github.com/php/php-src/tree/master/ext/spl">Исходники на Github</a></li>
</ul>