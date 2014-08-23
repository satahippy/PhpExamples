<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'RecursiveFilterIterator.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
        array('title' => 'RecursiveFilterIterator')
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
    Делает тоже самое, что и <a href="filter-iterator">FilterIterator</a>, только рекурсивно.
</p>
<p>
    Так же надо реализовать метод <code>accept</code>.
</p>

<h2>Использование</h2>
<p>
    Заметьте! Для того чтобы фильтры создавались одинаковыми для всех внутренних итераторов необходимо переопределить метод <code>getChildren</code>.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class BlackListRecursiveFilterIterator extends RecursiveFilterIterator
{
    protected $blackList;

    public function __construct(RecursiveIterator $iterator, array $blackList = [])
    {
        parent::__construct($iterator);
        $this->blackList = $blackList;
    }

    public function accept()
    {
        if (!$this->hasChildren() && in_array($this->current(), $this->blackList)) {
            return false;
        }
        return true;
    }

    public function getChildren()
    {
        if (empty($this->ref)) {
            $this->ref = new ReflectionClass($this);
        }
        return $this->ref->newInstance($this->getInnerIterator()->getChildren(), $this->blackList);
    }
}

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

$arr = [
    'first',
    'second' => [
        'sf',
        'ss',
        'st' => [
            'first',
            'child1',
            'child2',
            'child3'
        ]
    ],
    'third'
];

printIterator(new BlackListRecursiveFilterIterator(new RecursiveArrayIterator($arr), ['first', 'ss']));
]]></script>

<pre>
<?php

class BlackListRecursiveFilterIterator extends RecursiveFilterIterator
{
    protected $blackList;

    public function __construct(RecursiveIterator $iterator, array $blackList = [])
    {
        parent::__construct($iterator);
        $this->blackList = $blackList;
    }

    public function accept()
    {
        if (!$this->hasChildren() && in_array($this->current(), $this->blackList)) {
            return false;
        }
        return true;
    }

    public function getChildren()
    {
        if (empty($this->ref)) {
            $this->ref = new ReflectionClass($this);
        }
        return $this->ref->newInstance($this->getInnerIterator()->getChildren(), $this->blackList);
    }
}

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

$arr = [
    'first',
    'second' => [
        'sf',
        'ss',
        'st' => [
            'first',
            'child1',
            'child2',
            'child3'
        ]
    ],
    'third'
];

printIterator(new BlackListRecursiveFilterIterator(new RecursiveArrayIterator($arr), ['first', 'ss']));
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.recursivefilteriterator.php">Официальная документация</a></li>
</ul>