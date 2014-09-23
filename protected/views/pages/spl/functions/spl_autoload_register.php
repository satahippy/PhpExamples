<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'spl_autoload_register.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'spl_autoload_register')
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
    Регистрирует функцию-автозагрузчик.
</p>

<h2>Немного истории</h2>
<h3>require_once/include_once</h3>
<p>
    Когда то давно для того чтобы использовать какой то класс, определённый в другом файле, надо было вручную его подключать с помощью <code>require_once/include_once</code>. Всё просто - указываем путь, по которому расположен необходимый файл.
</p>
<p>
    Прямолинейно и неудобно!
</p>

<h3>__autoload</h3>
<p>
    И вот в php 5, нам представили средство автоматической загрузки классов. Каждый раз, когда php не может найти класс он обращается к функции <code>__autoload</code>, которая должна попытаться подключить соответствующий файл. 
</p>
<p>
    Но вот ведь незадача, в таком случае, у нас может быть всего один автозагрузчик.
</p>

<h3>SPL автозагрузка</h3>
<p>
    И тут на сцене появляется SPL, он предоставляет целых <a href="./#autoloading">6 функций для автозагрузки</a>. Который предоставляет больше возможностей для управления автозагрузкой.
</p>
<p>
    Теперь вы можете регистрировать несколько загрузчиков, отключать загузчики, в какой то мере манипулировать порядком автозагрузчиков и т.п.
</p>

<h3>Composer</h3>
<p>
    Но в современном мире, всё горадо проще. Теперь нет необходимости писать свои автозагрузчики, которые потом кому то придётся поключать и всё такое. Всё это справедливо только в том случае, если вы пользуетесь <a href="https://getcomposer.org/">composer</a>. Просто пропишите правила загрузки вашего пакета в файла composer'а и подключите сгененрированный autoload.
</p>

<h2>Пример</h2>
<p>
    Будем пытаться загружать класс <code>TestClass</code>, который расположен в <code>./test/TestClass.php</code>
</p>


<script type="syntaxhighlighter" class="brush: php"><![CDATA[
spl_autoload_register(function ($class) {
    echo "trying load class...\n";
    $file = __DIR__ . '/test/' . $class . '.php';
    if (is_file($file)) {
        include_once $file;
        echo "we made it!";
    }
});

$test = new TestClass();
]]></script>

<pre>
<?php
function my_autoloader($class)
{
    echo "trying load class...\n";
    $file = __DIR__ . '/test/' . $class . '.php';
    if (is_file($file)) {
        include_once $file;
        echo "we made it!";
    }
}
spl_autoload_register('my_autoloader');

$test = new TestClass();
?>
</pre>

<h2>Параметры</h2>
<ul>
    <li>Первым параметром мы определяем нашу функцию автозагрузчик</li>
    <li>Вторым определяем, надо ли выбрасывать исеключение, если автозагрузчик не получилось зарегистрировать</li>
    <li>Если третьим параметром передаём <code>true</code>, то автозагрузчик будет добавлен в начало стэка</li>
</ul>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
function my_autoloader1($class)
{
    echo "autoloader1\n";
}

function my_autoloader2($class)
{
    echo "autoloader2";
}

spl_autoload_register('my_autoloader1', false, true);
spl_autoload_register('my_autoloader2', false, false);

$test = new TestClass2();
]]></script>

<pre>
<?php
function my_autoloader1($class)
{
    echo "autoloader1\n";
}

function my_autoloader2($class)
{
    echo "autoloader2";
}

spl_autoload_register('my_autoloader1', false, true);
spl_autoload_register('my_autoloader2', false, false);

$test = new TestClass2();
?>
</pre>

<p>
    Если вызвать <code>spl_autoload_register</code>, то будет зарегистрирован автозагрузчик по дефолту - <a href="spl_autoload">spl_autoload</a>.
</p>

<h2>Взаимодействие с __autoload</h2>
<p>
    Функцию <code>__autoload</code> необходимо явным образом регистрировать с помощью <code>spl_autoload_register</code>, в противном случае, она исключиться из стэка автозагрузчиков при первом вызове <code>spl_autoload_register</code>.
</p>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/language.oop5.autoload.php">Автоматическая загрузка классов. Официальная документация</a></li>
    <li><a href="http://php.net/manual/ru/function.spl-autoload-register.php">spl_autoload_register. Официальная документация</a></li>
    <li><a href="http://php.net/manual/ru/function.autoload.php">__autoload. Официальная документация</a></li>
    <li><a href="http://habrahabr.ru/post/136761/">неплохая вводная статья в автозагрузчики</a></li>
    <li><a href="http://habrahabr.ru/post/138920/">неплохая статья на тему проблемы автозагрузчиков</a></li>
</ul>