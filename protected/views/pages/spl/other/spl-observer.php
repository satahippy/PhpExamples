<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'SplObserver.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Разное', 'url' => '/spl/other/'),
        array('title' => 'SplObserver')
    )
);
echo $view->render(
    'partials/syntax_highlighter.php',
    array(
        'brushes' => array('Php')
    )
);
?>

<h2>Описание</h2>
<blockquote>
    Интерфейс <a href="spl-subject">SplSubject</a> используется совместно с <a href="spl-observer">SplObserver</a> для реализации шаблона проектирования <a href="https://ru.wikipedia.org/wiki/%D0%9D%D0%B0%D0%B1%D0%BB%D1%8E%D0%B4%D0%B0%D1%82%D0%B5%D0%BB%D1%8C_(%D1%88%D0%B0%D0%B1%D0%BB%D0%BE%D0%BD_%D0%BF%D1%80%D0%BE%D0%B5%D0%BA%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F)">Наблюдатель (Observer)</a>.
</blockquote>
<p>
    В паттерне Наблюдатель выполняет роль подписчика (тот кто следит).
</p>
<p>
    <b>Внимание!</b> Это только интерфейсы, они не предоставляют какой то реализации, в отличии от Java.
</p>

<h2>Использование</h2>
<p>
    Смотри на странице <a href="spl-subject">SplSubject</a>.
</p>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.splobserver.php">Официальная документация</a></li>
    <li><a href="https://ru.wikipedia.org/wiki/%D0%9D%D0%B0%D0%B1%D0%BB%D1%8E%D0%B4%D0%B0%D1%82%D0%B5%D0%BB%D1%8C_(%D1%88%D0%B0%D0%B1%D0%BB%D0%BE%D0%BD_%D0%BF%D1%80%D0%BE%D0%B5%D0%BA%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F)">Паттерн Наблюдатель (Observer)</a></li>
</ul>
