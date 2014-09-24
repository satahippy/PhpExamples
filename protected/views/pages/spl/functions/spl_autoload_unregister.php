<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'spl_autoload_unregister.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'spl_autoload_unregister')
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
    Отменяет функцию-автозагрузчик, добавленную ранее с помощью <a href="spl_autoload_register">spl_autoload_register</a>.
</p>
<p>
    Если после отмены стэк оказывается пустым, то деактивирует автозагрузку.
</p>

<h2>Пример</h2>
<p>
    Загрузим несколько автозагузчиков, несколькими разными способами и попробуем и выгурзить.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
function my_autoloader($class) { }

class Loader
{
    public static function autoload($class) { }
}

$autoloader = function ($class) { };

spl_autoload_register('my_autoloader');
spl_autoload_register(['Loader', 'autoload']);
spl_autoload_register($autoloader);

var_dump(spl_autoload_functions());

spl_autoload_unregister('my_autoloader');
spl_autoload_unregister(['Loader', 'autoload']);
spl_autoload_unregister($autoloader);

var_dump(spl_autoload_functions());
]]></script>

<pre>
<?php
function my_autoloader($class) { }

class Loader
{
    public static function autoload($class) { }
}

$autoloader = function ($class) { };

spl_autoload_register('my_autoloader');
spl_autoload_register(['Loader', 'autoload']);
spl_autoload_register($autoloader);

var_dump(spl_autoload_functions());

spl_autoload_unregister('my_autoloader');
spl_autoload_unregister(['Loader', 'autoload']);
spl_autoload_unregister($autoloader);

var_dump(spl_autoload_functions());
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.spl-autoload-unregister.php">Официальная документация</a></li>
</ul>