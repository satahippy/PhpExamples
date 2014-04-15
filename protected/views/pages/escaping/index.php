<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Экранирование.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Экранирование символов и т.п.')
));
?>
<ul>
	<li><a href="htmlspecialchars">htmlspecialchars</a></li>
	<li><a href="htmlentities">htmlentities</a></li>
	<li><a href="strip_tags">strip_tags/fgetss</a></li>
	<li><a href="urlencode">urlencode/rawurlencode</a></li>
	<li><a href="addslashes">addslashes/addcslashes</a></li>
</ul>