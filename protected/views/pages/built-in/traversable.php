<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Traversable.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Встроенные классы и интерфейсы', 'url' => '/built-in/'),
	array('title' => 'Traversable')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Интерфейс обозначающий, что класс является обходимым. Такой можно использовать в <code>foreach</code>.
</p>
<p>
	<!-- TODO добавить ссылки на IteratorAggregate и Iterator -->
	Реализовать его в принципе нельзя. Вместо этого надо реализовывать IteratorAggregate или Iterator.
</p>
<p>
	Но у него тоже есть своя полезность, с точки зрения использования интерфейсов. Т.е. вы всегда можете проверить является ли переменная перебираемой. Тем не менее массив, этот интерфейс не реализует.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class Printer
{
	public function printOut(Traversable $data)
	{
		foreach ($data as $item) {
			echo $item . "\n";
		}
	}
}

$printer = new Printer();
// you can't do it
//$printer->printOut(['item1', 'item2']);
$printer->printOut(SplFixedArray::fromArray(['item1', 'item2']));
]]></script>

<pre>
<?php

class Printer
{
	public function printOut(Traversable $data)
	{
		foreach ($data as $item) {
			echo $item . "\n";
		}
	}
}

$printer = new Printer();
// you can't do it
//$printer->printOut(['item1', 'item2']);
$printer->printOut(SplFixedArray::fromArray(['item1', 'item2']));

?>
</pre>