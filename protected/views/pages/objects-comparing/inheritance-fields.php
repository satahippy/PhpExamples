<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Сравнение объектов.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Сравнение объектов', 'url' => '/objects-comparing/'),
	array('title' => 'Сравниваются ли унаследованные поля?')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h1>Сравниваются ли унаследованные поля?</h1>
<p>
	Да
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
	class ParentClass
	{
		public $parentField;
	}
	
	class ChildClass extends ParentClass
	{
		public $childField;
	}
	
	$obj1 = new ChildClass();
	$obj1->parentField = 'parent';
	$obj1->childField = 'child';
	
	$obj2 = new ChildClass();
	$obj2->parentField = 'parent';
	$obj2->childField = 'child';
	
	var_dump($obj1 == $obj2);
	
	$obj2->parentField = 'another';
	
	var_dump($obj1 == $obj2);
]]></script>

<?php
class ParentClass
{
	public $parentField;
}

class ChildClass extends ParentClass
{
	public $childField;
}

$obj1 = new ChildClass();
$obj1->parentField = 'parent';
$obj1->childField = 'child';

$obj2 = new ChildClass();
$obj2->parentField = 'parent';
$obj2->childField = 'child';

var_dump($obj1 == $obj2);

$obj2->parentField = 'another';

var_dump($obj1 == $obj2);
?>