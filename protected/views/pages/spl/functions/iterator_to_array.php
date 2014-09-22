<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'iterator_to_array.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'iterator_to_array')
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
    Копирует итератор в массив
</blockquote>
<p>
    По умолчанию использует ключи итератора, но это можно изменить вторым параметром.
</p>

<h2>Пример</h2>
<p>
    Попробуем скопировать отфильтрованный <a href="../iterators/array-iterator">ArrayIterator</a>.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new CallbackFilterIterator(
    new ArrayIterator(['one' => 100, 'two' => 0, 'three' => 50, 'four' => 4]), function ($current) {
        return $current > 10;
    }
);
var_dump(iterator_to_array($it));
]]></script>

<pre>
<?php
$it = new CallbackFilterIterator(
    new ArrayIterator(['one' => 100, 'two' => 0, 'three' => 50, 'four' => 4]), function ($current) {
        return $current > 10;
    }
);
var_dump(iterator_to_array($it));
?>
</pre>

<h2>Использование ключей итератора</h2>
<p>
    Будьте осторожны, когда используете ключи итератора, иногда они могут повторяться и тогда некоторые значения будут перезаписаны.
</p>

<h2><code>RecursiveIteratorIterator</code></h2>
<p>
    При использовании <a href="../iterators/recursive-iterator-iterator">RecursiveIteratorIterator</a> будет возвращён плоский массив.
    <br/>
    Более того, если вы используете ключи итератора, то большая часть значений просто пропадёт.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$arr = [
    'first',
    'second' => [
        'sf',
        'ss',
        'st' => [
            'child1',
            'child2',
            'child3'
        ]
    ],
    'third'
];
$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr));

echo "use iterator keys:";
var_dump(iterator_to_array($it, true));

echo "don't use iterator keys:";
var_dump(iterator_to_array($it, false));
]]></script>

<pre>
<?php
$arr = [
    'first',
    'second' => [
        'sf',
        'ss',
        'st' => [
            'child1',
            'child2',
            'child3'
        ]
    ],
    'third'
];
$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr));

echo "use iterator keys:";
var_dump(iterator_to_array($it, true));

echo "don't use iterator keys:";
var_dump(iterator_to_array($it, false));
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.iterator-to-array.php">Официальная документация</a></li>
</ul>