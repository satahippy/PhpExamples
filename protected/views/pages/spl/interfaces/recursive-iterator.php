<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'RecursiveIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Интерфейсы', 'url' => '/spl/interfaces/'),
	array('title' => 'RecursiveIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Интерфейс для итераторов, которые работают рекурсивно.
</p>
<p>
	Собственно наследуется от <a href="/built-in/iterator">Iterator</a> и добавляет 2 новых метода для реализации:
</p>
<ul>
	<li><code>hasChildren</code> - проверяет, можно ли создать итератор для дочернего элемента</li>
	<li><code>getChildren</code> - возвращает итератор для дочернего элемента. Вообще, судя по документации это тоже должен быть <code>RecursiveIterator</code></li>
</ul>

<h2>Пример реализации</h2>
<p>
	Будем делать итератор, который обходит дерево.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
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

function printTree(TreeIterator $tree, $step = 0)
{
	$tree->rewind();
	while ($tree->valid()) {
		echo str_repeat("\t", $step) . $tree->current()->title . "\n";
		if ($tree->hasChildren()) {
			printTree($tree->getChildren(), $step + 1);
		}
		$tree->next();
	}
}

$nodes = [];
fillTree($nodes, 3);
printTree(new TreeIterator($nodes));
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

function printTree(TreeIterator $tree, $step = 0)
{
	$tree->rewind();
	while ($tree->valid()) {
		echo str_repeat("\t", $step) . $tree->current()->title . "\n";
		if ($tree->hasChildren()) {
			printTree($tree->getChildren(), $step + 1);
		}
		$tree->next();
	}
}

$nodes = [];
fillTree($nodes, 3);
printTree(new TreeIterator($nodes));
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.recursivearrayiterator.php">Официальная документация</a></li>
</ul>