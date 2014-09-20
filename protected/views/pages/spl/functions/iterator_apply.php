<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'iterator_apply.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'iterator_apply')
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
    Вызывает функцию для каждого элемента итератора.
</p>
<p>
    Третьим параметром можно указать аргументы, которые будут передаваться в функцию.
</p>
<p>
    Для того, чтобы обход продолжался дальше, необходимо, чтобы функция вернула <code>true</code>.
</p>

<h2>Пример</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
function step(Iterator $it)
{
    echo $it->current()."\n";
    return true;
}

$it = new ArrayIterator(['one', 'two', 'three']);
iterator_apply($it, 'step', [$it]);
]]></script>

<pre>
<?php
function step(Iterator $it)
{
    echo $it->current()."\n";
    return true;
}

$it = new ArrayIterator(['one', 'two', 'three']);
iterator_apply($it, 'step', [$it]);
?>
</pre>

<h2>Недостатки</h2>
<p>
    <code>iterator_apply</code> может быть неочень удобна, если вы не владеете функцией, которую хотите применить для каждого элемента.
</p>
<p>
    Потому что внутри функции нужно получить доступ к текущему элементу и вернуть <code>true</code>.
</p>
<p>
    Но конечно всегда есть выход.
</p>
<p>
    Попробуем получить массив значений, где к каждому элементу применена <code>ucfirst</code>.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$result = [];
iterator_apply(
    $it,
    function (Iterator $it) use (&$result, &$result2) {
        $result[] = ucfirst($it->current());
        return true;
    },
    [$it]
);
echo implode(', ', $result) . "\n";
]]></script>

<pre>
<?php
$result = [];
iterator_apply(
    $it,
    function (Iterator $it) use (&$result, &$result2) {
        $result[] = ucfirst($it->current());
        return true;
    },
    [$it]
);
echo implode(', ', $result) . "\n";
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.iterator-apply.php">Официальная документация</a></li>
</ul>