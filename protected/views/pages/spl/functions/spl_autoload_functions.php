<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'spl_autoload_functions.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'spl_autoload_functions')
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
<p>
    Возвращает список всех зарегистрированных функций-автозагрузчиков.
</p>
<p>
    Если стэк автозагрузчки ещё не активирован, вернёт <code>false</code>.
</p>

<h2>Пример</h2>
<p>
    Зарегистрируем ещё один автозагрузчик, а потом попробуем получить весь их список.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
function my_autoloader($class)  { }
spl_autoload_register('my_autoloader');

var_dump(spl_autoload_functions());
]]></script>

<pre>
<?php
function my_autoloader($class)  { }
spl_autoload_register('my_autoloader');

var_dump(spl_autoload_functions());
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.spl-autoload-functions.php">Официальная документация</a></li>
</ul>