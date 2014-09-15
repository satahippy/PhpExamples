<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Разное.');
$view['slots']->set('breadcrumbs', array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Разное')
    ));
?>

<p>
    Тут представлены разные полезные классы.
</p>

<ul>
    <li><a href="array-object">ArrayObject</a></li>
    <li><a href="spl-subject">SplSubject</a></li>
</ul>

<h2>Ссылки:</h2>
<ul>
    <li>
        <a href="http://php.net/manual/ru/spl.misc.php">Официальная документация</a>
    </li>
</ul>