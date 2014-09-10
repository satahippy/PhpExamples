<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Работа с файлами.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Работа с файлами')
));
?>

<p>
    Прежде всего, всё что можно делать с помощью этих классов, можно делать и с помощью обычных функций. Данные классы просто предоставляют удобный ООП интерфейс.
</p>
<p>
    По мимо прочего, все файловые итераторы наследуются от <a href="spl-file-info">SplFileInfo</a>, а значит во многом наследуют и его поведение.
</p>

<ul>
	<li><a href="spl-file-info">SplFileInfo</a></li>
</ul>

<h2>Ссылки:</h2>
<ul>
	<li>
		<a href="http://php.net/manual/ru/spl.files.php">Официальная документация</a>
	</li>
</ul>