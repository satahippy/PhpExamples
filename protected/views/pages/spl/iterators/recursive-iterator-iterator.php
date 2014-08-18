<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'RecursiveIteratorIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'RecursiveIteratorIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Предназначен для обхода рекурсивных итераторов, без рекурсии и т.п.
</p>
<p>
    При этом вы можете использовать любую последовательность вложенных итераторов, главное чтобы метод <code>getChildren</code> возвращал <code>RecursiveIterator</code>.
</p>

<h2>Производительность</h2>
<p>
    Как ни странно, но это его слабая сторона. Итерация происходит гораздо медленнее, чем простой обход.
</p>

<h2>Использование</h2>
<p>
    Как пример - построение дерева из массива.
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

function printIterator($iterator)
{
    foreach ($iterator as $key => $val) {
        if (!$iterator->callHasChildren()) {
            $text = $val;
        } else {
            $text = $key;
        }
        echo str_repeat("\t", $iterator->getDepth())."$text\n";
    }
}

$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr), RecursiveIteratorIterator::SELF_FIRST);

echo "--full iterate\n";
printIterator($it);

echo "\n--only 1 level\n";
$it->setMaxDepth(1);
printIterator($it);
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

function printIterator($iterator)
{
    foreach ($iterator as $key => $val) {
        if (!$iterator->callHasChildren()) {
            $text = $val;
        } else {
            $text = $key;
        }
        echo str_repeat("\t", $iterator->getDepth())."$text\n";
    }
}

$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr), RecursiveIteratorIterator::SELF_FIRST);

echo "--full iterate\n";
printIterator($it);

echo "\n--only 1 level\n";
$it->setMaxDepth(1);
printIterator($it);
?>
</pre>

<p>
    Другой пример это обход дерева из примера <a href="../interfaces/recursive-iterator">отсюда</a>.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
function printTree(RecursiveIteratorIterator $tree)
{
    foreach ($tree as $val) {
        echo str_repeat("\t", $tree->getDepth())."$val->title\n";
    }
}
printTree(new RecursiveIteratorIterator(new TreeIterator($nodes), RecursiveIteratorIterator::SELF_FIRST));
]]></script>

<pre>
<?php

class Node
{
    public $title;
    public $child = [];

    public function __construct($title)
    {
        $this->title = $title;
    }
}

class TreeIterator implements RecursiveIterator
{
    protected $nodes;
    protected $index;

    public function __construct($nodes)
    {
        $this->nodes = $nodes;
    }

    public function current()
    {
        return $this->nodes[$this->index];
    }

    public function next()
    {
        $this->index++;
    }

    public function key()
    {
        return $this->index;
    }

    public function valid()
    {
        return isset($this->nodes[$this->index]);
    }

    public function rewind()
    {
        $this->index = 0;
    }

    public function hasChildren()
    {
        return count($this->current()->child) > 0;
    }

    public function getChildren()
    {
        return new TreeIterator($this->current()->child);
    }
}

function fillTree(&$nodes, $depth)
{
    if ($depth == 0) {
        return;
    }

    for ($i = 0; $i < $depth; $i++) {
        $node = new Node('Node ' . ($i + 1));
        fillTree($node->child, $i);
        $nodes[$i] = $node;
    }
}

function printTree(RecursiveIteratorIterator $tree)
{
    foreach ($tree as $val) {
        echo str_repeat("\t", $tree->getDepth())."$val->title\n";
    }
}

$nodes = [];
fillTree($nodes, 3);
printTree(new RecursiveIteratorIterator(new TreeIterator($nodes), RecursiveIteratorIterator::SELF_FIRST));
?>
</pre>

<h2><code>getSubIterator</code> vs <code>getInnerIterator</code></h2>
<p>
    И <code>getSubIterator</code> и <code>getInnerIterator</code> отдают ссылку на текущий итератор.
    <br/>
    Разница только в том, что <code>getSubIterator</code> позволяет указать уровень вложенности итератора, который мы хотим получить.
</p>

<h2>Другие методы</h2>
<p>
    Судя по исходным кодам, есть некоторые методы зацепки (хуки), которые изначальна имеют пустую реализацию и понятное дело, мы можем их использовать в своих интересах.
    <br/>
    Вот эти методы:
</p>
<ul>
    <li><code>beginChildren</code></li>
    <li><code>beginIteration</code></li>
    <li><code>endChildren</code></li>
    <li><code>endIteration</code></li>
    <li><code>nextElement</code></li>
</ul>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class RecursiveLogIteratorIterator extends RecursiveIteratorIterator
{
    public function beginChildren()
    {
        echo "--begin children\n";
    }

    public function beginIteration()
    {
        echo "--begin iteration\n";
    }

    public function endChildren()
    {
        echo "--end children\n";
    }

    public function endIteration()
    {
        echo "--end iteration\n";
    }

    public function nextElement()
    {
        echo "--next element\n";
    }
}

$it = new RecursiveLogIteratorIterator(new RecursiveArrayIterator($arr), RecursiveIteratorIterator::SELF_FIRST);

foreach ($it as $key => $val) {
    if (!$it->callHasChildren()) {
        $text = $val;
    } else {
        $text = $key;
    }
    echo "$text\n";
}
]]></script>

<pre>
<?php

class RecursiveLogIteratorIterator extends RecursiveIteratorIterator
{
    public function beginChildren()
    {
        echo "--begin children\n";
    }

    public function beginIteration()
    {
        echo "--begin iteration\n";
    }

    public function endChildren()
    {
        echo "--end children\n";
    }

    public function endIteration()
    {
        echo "--end iteration\n";
    }

    public function nextElement()
    {
        echo "--next element\n";
    }
}

$it = new RecursiveLogIteratorIterator(new RecursiveArrayIterator($arr), RecursiveIteratorIterator::SELF_FIRST);

foreach ($it as $key => $val) {
    if (!$it->callHasChildren()) {
        $text = $val;
    } else {
        $text = $key;
    }
    echo "$text\n";
}
?>
</pre>

<h2><code>callGetChildren</code> и <code>callHasChildren</code></h2>
<p>
    Это просто методы, которые делегируются текущему итератору. 
</p>

<h2>Методы работы и флаги</h2>
<p>
    Опять же предназначены для влияния на работу итератора.
</p>

<h3>Методы работы</h3>
<ul>
    <li><code>LEAVES_ONLY</code> - перебирает только конечные звенья (которые не имеют детей). Используется по дефолту.</li>
    <li><code>SELF_FIRST</code> - перебирает всё, но первым итерирует родителя</li>
    <li><code>CHILD_FIRST</code> - перебирает всё, но первым итерирует детей</li>
</ul>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
echo "--LEAVES_ONLY\n";
$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr), RecursiveIteratorIterator::LEAVES_ONLY);
printIterator($it);

echo "\n--SELF_FIRST\n";
$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr), RecursiveIteratorIterator::SELF_FIRST);
printIterator($it);

echo "\n--CHILD_FIRST\n";
$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr), RecursiveIteratorIterator::CHILD_FIRST);
printIterator($it);
]]></script>

<pre>
<?php
echo "--LEAVES_ONLY\n";
$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr), RecursiveIteratorIterator::LEAVES_ONLY);
printIterator($it);

echo "\n--SELF_FIRST\n";
$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr), RecursiveIteratorIterator::SELF_FIRST);
printIterator($it);

echo "\n--CHILD_FIRST\n";
$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($arr), RecursiveIteratorIterator::CHILD_FIRST);
printIterator($it);
?>
</pre>

<h3>Флаги</h3>
<p>
   На самом деле, флаг только один - <code>CATCH_GET_CHILD</code> и если он установлен, но итератор будет игнорировать исключения в <code>getChildren</code>.  
</p>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.recursiveiteratoriterator.php">Официальная документация</a></li>
</ul>