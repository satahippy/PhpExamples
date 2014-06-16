<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Сравнение объектов.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Сравнение объектов', 'url' => '/objects-comparing/'),
	array('title' => 'Рекурсивное сравнение')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h1>Рекурсивное сравнение</h1>
<p>
	Объекты сравниваются рекурсивно? Да.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class Class1
{
	public $field;
}

class Class2
{
	public $class1;
	public $field;
	
	public function __construct()
	{
		$this->class1 = new Class1();
	}
}

$obj1 = new Class2();
$obj1->field = 'field from class 2';
$obj1->class1->field = 'field from class 1';

$obj2 = new Class2();
$obj2->field = 'field from class 2';
$obj2->class1->field = 'field from class 1';

var_dump($obj1 == $obj2);

$obj2->class1->field = 'another';

var_dump($obj1 == $obj2);
]]></script>

<?php
class Class1
{
	public $field;
}

class Class2
{
	public $class1;
	public $field;
	
	public function __construct()
	{
		$this->class1 = new Class1();
	}
}

$obj1 = new Class2();
$obj1->field = 'field from class 2';
$obj1->class1->field = 'field from class 1';

$obj2 = new Class2();
$obj2->field = 'field from class 2';
$obj2->class1->field = 'field from class 1';

var_dump($obj1 == $obj2);

$obj2->class1->field = 'another';

var_dump($obj1 == $obj2);
?>

<h2>ОПАСНО!!! В связи с этим можно попасть "в петлю сравнений"</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class RecursiveClass
{
	public $relative;
}

$obj1 = new RecursiveClass();
$obj2 = new RecursiveClass();

$obj1->relative = $obj2;
$obj2->relative = $obj1;

$obj1 == $obj2;
]]></script>
<p>
	Такая конструкция выведет эксепшн: <code>Fatal error: Nesting level too deep - recursive dependency?</code>
</p>