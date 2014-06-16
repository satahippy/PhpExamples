<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Сравнение объектов.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Сравнение объектов', 'url' => '/objects-comparing/'),
	array('title' => 'Влияние модификаторов доступа')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h1>Влияние модификаторов доступа</h1>
<p>
	Модификаторы доступа (<code>public/private/protected</code>) имеют значения? Нет. Сравниваются абсолютно все поля.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class ExampleClass
{
	public $field1;
	protected $field2;
	private $field3;

	function __construct($field1, $field2, $field3)
	{
		$this->field1 = $field1;
		$this->field2 = $field2;
		$this->field3 = $field3;
	}
}

$obj1 = new ExampleClass('public', 'protected', 'private');
$obj2 = new ExampleClass('public', 'protected', 'private');
$obj3 = new ExampleClass('public', 'protected', 'private1');
$obj4 = new ExampleClass('public', 'protected1', 'private');

var_dump($obj1 == $obj2);
var_dump($obj1 == $obj3);
var_dump($obj1 == $obj4);
]]></script>

<?php
class ExampleClass
{
	public $field1;
	protected $field2;
	private $field3;

	function __construct($field1, $field2, $field3)
	{
		$this->field1 = $field1;
		$this->field2 = $field2;
		$this->field3 = $field3;
	}
}

$obj1 = new ExampleClass('public', 'protected', 'private');
$obj2 = new ExampleClass('public', 'protected', 'private');
$obj3 = new ExampleClass('public', 'protected', 'private1');
$obj4 = new ExampleClass('public', 'protected1', 'private');

var_dump($obj1 == $obj2);
var_dump($obj1 == $obj3);
var_dump($obj1 == $obj4);
?>