<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Сравнение объектов.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Сравнение объектов')
));
?>
<p>
	Для меня было новостью, как PHP сравнивает объекты.
</p>
<p>
	Дело в том, что есть 2 режима сравнения.
</p>
<ul>
	<li><code>===</code> - классическое сравнение: объекты сравниваются по ссылке</li>
	<li><code>==</code> - 2 объекта считаются равными, если они объекты одного класса и их поля равны</li>
</ul>

<h2>Детали работы <code>==</code></h2>
<ul>
	<li><a href="inheritance-fields">Сравнение объектов</a></li>
	<li><a href="recursive">Рекурсивное сравнение</a></li>
	<li><a href="fields-visibility">Влияние модификаторов доступа</a></li>
</ul>

<h2>Ссылки:</h2>
<ul>
	<li>
		<a href="http://www.php.net//manual/ru/language.oop5.object-comparison.php">Инфа о сравнении объектов на официальном сайте</a>
	</li>
</ul>