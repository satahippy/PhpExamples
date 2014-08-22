<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'RecursiveCachingIterator.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
        array('title' => 'RecursiveCachingIterator')
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
    То же самое, что и <a href="caching-iterator">CachingIterator</a>, только рекурсивный, ну и конечно же предназначен для рекурсивных итераторов. + кэширует работу методов
    <code>hasChildren()</code> и <code>getChildren()</code>.
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class TestRecursiveIterator extends RecursiveArrayIterator
{
    public function key()
    {
        echo '(call original key)';
        return parent::key();
    }

    public function current()
    {
        echo '(call original current)';
        return parent::current();
    }

    public function hasChildren()
    {
        echo '(call original hasChildren)';
        return parent::hasChildren();
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
    'third'
];

function printIterator(RecursiveIterator $it, $step = 0)
{
    $it->rewind();
    while ($it->valid()) {
        // call hasChildren() twice
        if ($it->hasChildren() && $it->hasChildren()) {
            // call key() twice
            echo str_repeat("\t", $step) . $it->key() . " and again " . $it->key() . "\n";
            printIterator($it->getChildren(), $step + 1);
        } else {
            // call current() twice
            echo str_repeat("\t", $step) . $it->current() . " and again " . $it->current() . "\n";
        }
        $it->next();
    }
}

printIterator(new RecursiveCachingIterator(new TestRecursiveIterator($arr), RecursiveCachingIterator::TOSTRING_USE_CURRENT));
]]></script>

<pre>
<?php

class TestRecursiveIterator extends RecursiveArrayIterator
{
    public function key()
    {
        echo '(call original key)';
        return parent::key();
    }

    public function current()
    {
        echo '(call original current)';
        return parent::current();
    }

    public function hasChildren()
    {
        echo '(call original hasChildren)';
        return parent::hasChildren();
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
    'third'
];

function printIterator(RecursiveIterator $it, $step = 0)
{
    $it->rewind();
    while ($it->valid()) {
        // call hasChildren() twice
        if ($it->hasChildren() && $it->hasChildren()) {
            // call key() twice
            echo str_repeat("\t", $step) . $it->key() . " and again " . $it->key() . "\n";
            printIterator($it->getChildren(), $step + 1);
        } else {
            // call current() twice
            echo str_repeat("\t", $step) . $it->current() . " and again " . $it->current() . "\n";
        }
        $it->next();
    }
}

printIterator(new RecursiveCachingIterator(new TestRecursiveIterator($arr), RecursiveCachingIterator::TOSTRING_USE_CURRENT));
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.recursivecachingiterator.php">Официальная документация</a></li>
</ul>