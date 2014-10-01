<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'spl_autoload_call.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'spl_autoload_call')
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
    Пытается загрузить класс всеми зарегистрированными автозагрузчиками, пока не загрузит его. При этом неявно будут загружены все необходимые классы.
</p>
<p>
    На самом деле очень редко применяется, потому что все классы загружаются автоматически.
</p>
<p>
    Более того, попытка загрузки уже загруженного класса может выбросить исключение.
</p>

<h2>Пример</h2>
<p>
    Попробуем вручную загрузить класс <code>TestClass</code>
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
function my_autoloader($class)
{
    $file = __DIR__ . '/test/' . $class . '.php';
    if (is_file($file)) {
        include_once $file;
    }
}
spl_autoload_register('my_autoloader');

function printClassExists($class)
{
    echo "$class: " . (class_exists('TestClass', false) ? 'true' : 'false') . "\n";
}

printClassExists('TestClass');
spl_autoload_call('TestClass');
printClassExists('TestClass');
]]></script>

<pre>
<?php
function my_autoloader($class)
{
    $file = __DIR__ . '/test/' . $class . '.php';
    if (is_file($file)) {
        include_once $file;
    }
}
spl_autoload_register('my_autoloader');

function printClassExists($class)
{
    echo "$class: " . (class_exists('TestClass', false) ? 'true' : 'false') . "\n";
}

printClassExists('TestClass');
spl_autoload_call('TestClass');
printClassExists('TestClass');
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.spl-autoload-call.php">Официальная документация</a></li>
</ul>