<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'RecursiveArrayIterator.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
        array('title' => 'RecursiveArrayIterator')
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
    Делает тоже самое что и
    <a href="array-iterator">ArrayIterator</a>, только может работать с многоуровневой вложенностью.
</p>
<p>
    Довольно часто вмести с ним используют <a href="recursive-iterator-iterator">RecursiveIteratorIterator</a>.
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class Object
{
    public $text1 = 'test1';
    public $text2 = 'test2';
    public $text3 = 'test3';
    
    public function __toString()
    {
        return 'i am object!';
    }
}

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
    'third',
    'object' => new Object()
];

function printIterator(RecursiveIterator $tree, $step = 0)
{
    $tree->rewind();
    while ($tree->valid()) {
        if ($tree->hasChildren()) {
            echo str_repeat("\t", $step) . $tree->key() . "\n";
            printIterator($tree->getChildren(), $step + 1);
        } else {
            echo str_repeat("\t", $step) . $tree->current() . "\n";
        }
        $tree->next();
    }
}

printIterator(new RecursiveArrayIterator($arr));
]]></script>

<pre>
<?php

class Object
{
    public $text1 = 'test1';
    public $text2 = 'test2';
    public $text3 = 'test3';
    
    public function __toString()
    {
        return 'i am object!';
    }
}

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
    'third',
    'object' => new Object()
];

function printIterator(RecursiveIterator $tree, $step = 0)
{
    $tree->rewind();
    while ($tree->valid()) {
        if ($tree->hasChildren()) {
            echo str_repeat("\t", $step) . $tree->key() . "\n";
            printIterator($tree->getChildren(), $step + 1);
        } else {
            echo str_repeat("\t", $step) . $tree->current() . "\n";
        }
        $tree->next();
    }
}

printIterator(new RecursiveArrayIterator($arr));
?>
</pre>

<h2><code>RecursiveArrayIterator::CHILD_ARRAYS_ONLY</code></h2>
<p>
    Интересная штука! Вообще <code>RecursiveArrayIterator</code> как и <code>ArrayIterator</code> обходит и массивы и объекты, и не всегда это удобно.
</p>
<p>
    Можно конечно вручную проверять тип текущего элемента. Но есть интересный недокументированный флаг - <code>RecursiveArrayIterator::CHILD_ARRAYS_ONLY</code>.
    <br/>
    Он позволяет обходить только массивы.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
printIterator(new RecursiveArrayIterator($arr, RecursiveArrayIterator::CHILD_ARRAYS_ONLY));
]]></script>

<pre>
<?php
printIterator(new RecursiveArrayIterator($arr, RecursiveArrayIterator::CHILD_ARRAYS_ONLY));
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.recursivearrayiterator.php">Официальная документация</a></li>
</ul>