<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'spl_autoload_extensions.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'spl_autoload_extensions')
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
    Расширения файлов для функции <a href="spl_autoload">spl_autoload</a>.
</p>
<p>
    Если вызывается без параметров - отдаёт зарегистрированные расширения. 
</p>
<p>
    Если с параметром - определяет эти расширения. Должны быть перечислены параметры через запятую (одной строкой).
</p>
<p>
    Расширения по дефолту - .php и .inc.
</p>

<h2>Пример</h2>
<p>
    Укажем 2 расширения .php и .class.php. Класс <code>TestClass</code> располагается в файле TestClass.php, класс <code>Test</code> в файле Test.class.php.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
function printClassExists($class)
{
    echo "$class: " . (class_exists('TestClass') ? 'true' : 'false') . "\n";
}

printClassExists('TestClass');
printClassExists('Test');

set_include_path(__DIR__.'/test/');
spl_autoload_extensions('.php,.class.php');
spl_autoload('TestClass');
spl_autoload('Test');

printClassExists('TestClass');
printClassExists('Test');
]]></script>

<pre>
<?php
function printClassExists($class)
{
    echo "$class: " . (class_exists('TestClass') ? 'true' : 'false') . "\n";
}

printClassExists('TestClass');
printClassExists('Test');

set_include_path(__DIR__.'/test/');
spl_autoload_extensions('.php,.class.php');
spl_autoload('TestClass');
spl_autoload('Test');

printClassExists('TestClass');
printClassExists('Test');
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.spl-autoload-extensions.php">Официальная документация</a></li>
</ul>