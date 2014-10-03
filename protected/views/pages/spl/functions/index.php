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

<h3 id="classes">Работа с классами</h3>
<ul>
    <li><a href="class_implements">class_implements</a> - возвращает список реализованных интерфейсов класса</li>
    <li><a href="class_parents">class_parents</a> - возвращает список родителей класса</li>
    <li><a href="class_uses">class_uses</a> - возвращает список используемых трейтов</li>
</ul>

<h3 id="iterators">Работа с итераторами</h3>
<ul>
    <li><a href="iterator_apply">iterator_apply</a> - выполняет функцию для каждого элемента итератора</li>
    <li><a href="iterator_count">iterator_count</a> - считает количество элементов в итераторе</li>
    <li><a href="iterator_to_array">iterator_to_array</a> - копирует итератор в массив</li>
</ul>

<h3 id="autoloading">Работа с автозагрузкой</h3>
<ul>
    <li><a href="spl_autoload_register">spl_autoload_register</a> - регистрирует функцию-автозагрузчик</li>
    <li><a href="spl_autoload_unregister">spl_autoload_unregister</a> - снимаем функцию-автозагрузчик, добавленную ранее</li>
    <li><a href="spl_autoload">spl_autoload</a> - автозагрузчик по дефолту</li>
    <li><a href="spl_autoload_extensions">spl_autoload_extensions</a> - расширения файлов для функции <code>spl_autoload</code></li>
    <li><a href="spl_autoload_functions">spl_autoload_functions</a> - возвращет список всех зарегистрированных автозагрузчиков</li>
    <li><a href="spl_autoload_call">spl_autoload_call</a> - пытается загрузить класс всеми зарегистрированными автозагрузчиками</li>
</ul>

<h3 id="other">Разное</h3>
<ul>
    <li><a href="spl_classes">spl_classes</a> - возвращает список всех доступных на данный момент классов SPL</li>
    <li><a href="spl_object_hash">spl_object_hash</a> - возвращает хэш объекта</li>
</ul>

<h2>Ссылки:</h2>
<ul>
    <li>
        <a href="http://php.net/manual/ru/spl.files.php">Официальная документация</a>
    </li>
</ul>