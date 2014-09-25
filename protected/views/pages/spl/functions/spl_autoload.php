<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'spl_autoload.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'spl_autoload')
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
    Базовая реализация автозагрузчкика.
</p>
<p>
    Пытается загрузить класс (первый параметр) с указанным расширением (второй параметр). Поиск происходит по всем include путям. 
</p>
<p>
    Именно этот автозагрузчик будет зарегистрирован, если вызвать <a href="spl_autoload_register">spl_autoload_register</a> без параметров.
</p>

<h2>spl_autoload_register без параметров</h2>
<p>
    Стоит немного пояснить поведение <a href="spl_autoload_register">spl_autoload_register</a> при вызове без параметров. Дело в том, что он добавить <code>spl_autoload</code> только в том, случае, если стэк автозагрузки деактивирован. В противном случае, вызов будет просто проигнорирован.
</p>
<p>
    Заметьте! Именно деактивирован, а не просто пуст. Т.е. если вы сначала зарегистрировали какие то функции, а потом сняли из с регистрации, то последующий вызов <a href="spl_autoload_register">spl_autoload_register</a> без параметров не принесёт никаких результатов. 
</p>

<h2>Пример</h2>
<p>
    Укажем новый include путь и попытаемся загрузить класс с помощью <code>spl_autoload</code>
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
set_include_path(__DIR__.'/test/');
var_dump(class_exists('TestClass'));
spl_autoload('TestClass');
var_dump(class_exists('TestClass'));
]]></script>

<pre>
<?php
set_include_path(__DIR__.'/test/');
var_dump(class_exists('TestClass'));
spl_autoload('TestClass');
var_dump(class_exists('TestClass'));
?>
</pre>

<h2>Особенности</h2>
<p>
    Говорят, что этот автозагрузчик работает довольно быстро, потому что реализован непосредственно на C.
</p>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.spl-autoload.php">Официальная документация</a></li>
</ul>