<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'ParentIterator.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
        array('title' => 'ParentIterator')
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
    Реализация <a href="recursive-filter-iterator">RecursiveFilterIterator</a>.
</p>
<p>
    Обходит только те элементы, которые имеют потомков, т.е. отбрасывает "листья" итератора.
</p>

<h2>Использование</h2>
<p>
    Выведем все ключи, значения которых массивы.
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

function printIterator(ParentIterator $tree, $step = 0)
{
    $tree->rewind();
    while ($tree->valid()) {
        echo str_repeat("\t", $step) . $tree->key() . "\n";
        printIterator($tree->getChildren(), $step + 1);
        $tree->next();
    }
}

printIterator(new ParentIterator(new RecursiveArrayIterator($arr)));
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

function printIterator(ParentIterator $tree, $step = 0)
{
    $tree->rewind();
    while ($tree->valid()) {
        echo str_repeat("\t", $step) . $tree->key() . "\n";
        printIterator($tree->getChildren(), $step + 1);
        $tree->next();
    }
}

printIterator(new ParentIterator(new RecursiveArrayIterator($arr)));
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.parentiterator.php">Официальная документация</a></li>
</ul>