<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Встроенные классы и интерфейсы.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Встроенные классы и интерфейсы')
));
?>
<ul>
	<li><a href="traversable">Traversable</a></li>
	<li><a href="iterator">Iterator</a></li>
	<li><a href="iterator-aggregate">IteratorAggregate</a></li>
</ul>