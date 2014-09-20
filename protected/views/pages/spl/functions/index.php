<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Функции.');
$view['slots']->set('breadcrumbs', array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции')
    ));
?>

<p>
    SPL определяет некоторые глобальные функции. Которые можно разделить на несколько классов:
</p>

<h3>Работа с классами</h3>
<ul>
    <li><a href="class_implements">class_implements</a> - возвращает список реализованных интерфейсов класса</li>
    <li><a href="class_parents">class_parents</a> - возвращает список родителей класса</li>
    <li><a href="class_uses">class_uses</a> - возвращает список используемых трейтов</li>
</ul>

<h3>Работа с итераторами</h3>
<ul>
    <li><a href="iterator_apply">iterator_apply</a> - выполняет функцию для каждого элемента итератора</li>
</ul>

<h3>Работа с автозагрузкой</h3>

<h3>Разное</h3>

<h2>Ссылки:</h2>
<ul>
    <li>
        <a href="http://php.net/manual/ru/spl.files.php">Официальная документация</a>
    </li>
</ul>