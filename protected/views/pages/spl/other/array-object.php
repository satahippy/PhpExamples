<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'ArrayObject.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Разное', 'url' => '/spl/other/'),
        array('title' => 'ArrayObject')
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
    Предоставляет ООП доступ к массиву или доступ в стиле массива к объекту, в зависимости от обарачиваемого значения.
</p>

<h2>Использование</h2>
<p>
    Работаем с объект, как с массивом.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class TestObject
{
    public $prop1;
    public $prop2;
    public $prop3;

    public function __construct($prop1 = null, $prop2 = null, $prop3 = null)
    {
        $this->prop1 = $prop1;
        $this->prop2 = $prop2;
        $this->prop3 = $prop3;
    }
}

$test = new TestObject('aaa', 'bbb', 'ccc');
$arr = new ArrayObject($test);

echo $arr['prop1'] . "\n";
$arr['prop2'] = 'what?';
echo $test->prop2 . "\n";
]]></script>

<pre>
<?php

class TestObject
{
    public $prop1;
    public $prop2;
    public $prop3;

    public function __construct($prop1 = null, $prop2 = null, $prop3 = null)
    {
        $this->prop1 = $prop1;
        $this->prop2 = $prop2;
        $this->prop3 = $prop3;
    }
}

$test = new TestObject('aaa', 'bbb', 'ccc');
$arr = new ArrayObject($test);

echo $arr['prop1'] . "\n";
$arr['prop2'] = 'what?';
echo $test->prop2 . "\n";
?>
</pre>

<h2>Используемый итератор</h2>
<p>
    Вы можете сами определить, какой итератор будет использоваться для перебора значений. По дефолту: <a href="../iterators/array-iterator">ArrayIterator</a>.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class MyIterator extends ArrayIterator
{
    public function next()
    {
        echo "--next\n";
        parent::next();
    }
}

$arr = new ArrayObject(['one' => 'first', 'two' => 'second', 'three' => 'third']);
$arr->setIteratorClass('MyIterator');

foreach ($arr as $key => $val) {
    echo "$key: $val\n";
}
]]></script>

<pre>
<?php
class MyIterator extends ArrayIterator
{
    public function next()
    {
        echo "--next\n";
        parent::next();
    }
}

$arr = new ArrayObject(['one' => 'first', 'two' => 'second', 'three' => 'third']);
$arr->setIteratorClass('MyIterator');

foreach ($arr as $key => $val) {
    echo "$key: $val\n";
}
?>
</pre>

<h2>Флаги</h2>
<p>
    Флаги тут имеют то же значение, что и у <a href="../iterators/array-iterator">ArrayIterator</a>.
</p>

<h2>Массив как оборачиваемое значение</h2>
<p>
    Заметьте, что в отличии от объекта, модификации <code>ArrayObject</code> не влияют на исходный массив.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$source = ['one' => 'first', 'two' => 'second', 'three' => 'third'];
$dist = new ArrayObject($source);

$dist['one'] = 'uno';
echo $source['one']."\n";
]]></script>

<pre>
<?php
$source = ['one' => 'first', 'two' => 'second', 'three' => 'third'];
$dist = new ArrayObject($source);

$dist['one'] = 'uno';
echo $source['one']."\n";
?>
</pre>

<h2>Сортировка объекта</h2>
<p>
    Заметьте, что при этом меняется внутреннее устройство объекта.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$test = new TestObject('ссс', 'aaa', 'bbb');
var_dump($test);

$arr = new ArrayObject($test);
$arr->asort();
foreach ($arr as $key => $val) {
    echo "$key: $val\n";
}

var_dump($test);
]]></script>

<pre>
<?php
$test = new TestObject('ссс', 'aaa', 'bbb');
var_dump($test);

$arr = new ArrayObject($test);
$arr->asort();
foreach ($arr as $key => $val) {
    echo "$key: $val\n";
}

var_dump($test);
?>
</pre>

<h2>Производительность</h2>
<p>
    В более ранних версиях PHP, наблюдается резкое снижение производительности перебора с помощью <code>foreach</code>, по сравнению с перебором исходного массива.
</p>
<p>
    Но начиная с версии 5.3 эта проблема улажена.
</p>

<h2>Области применения</h2>
<p>
    На самом деле всё зависит от вашей фантазии, приведу несколько примеров.
</p>

<h3>Конфигурационный объект</h3>
<p>
    Если у вас есть конфигурационный массив, вы имеете возможность работать с ним как с объектом.
</p>
<p>
    И наоборот если у вас есть объект, который предоставляет вашу конфигурацию, вы можете легко работать с ним как с массивом.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$config = [
    'db_type' => 'mysql',
    'db_host' => 'localhost',
    'db_name' => 'php_test'
];
$configObj = new ArrayObject($config, ArrayObject::ARRAY_AS_PROPS);
echo $configObj->db_type . ':host=' . $configObj->db_host . ';dbname=' . $configObj->db_name;
]]></script>

<pre>
<?php
$config = [
    'db_type' => 'mysql',
    'db_host' => 'localhost',
    'db_name' => 'php_test'
];
$configObj = new ArrayObject($config, ArrayObject::ARRAY_AS_PROPS);
echo $configObj->db_type . ':host=' . $configObj->db_host . ';dbname=' . $configObj->db_name;
?>
</pre>

<h3>Данные пользователя</h3>
<p>
    Предположим у нас есть объект, который предоставляет некоторую информацию о пользователе. Нужно её перебрать так, как если бы это был простой массив.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class UserData
{
    public $name;
    public $age;
    public $language;
    
    public function __construct($name, $age, $language)
    {
        $this->name = $name;
        $this->age = $age;
        $this->language = $language;
    }
}
$user = new UserData('sata', 27, 'ru');

$userArr = new ArrayObject($user);
foreach ($userArr as $key => $val) {
    echo "$key: $val\n";
}
]]></script>

<pre>
<?php
class UserData
{
    public $name;
    public $age;
    public $language;
    
    public function __construct($name, $age, $language)
    {
        $this->name = $name;
        $this->age = $age;
        $this->language = $language;
    }
}
$user = new UserData('sata', 27, 'ru');

$userArr = new ArrayObject($user);
foreach ($userArr as $key => $val) {
    echo "$key: $val\n";
}
?>
</pre>

<h3>Массив + Дополнительные возможности <code>ArrayObject</code></h3>
<p>
    Конечно всё, что может делать <code>ArrayObject</code> можно сделать и с помощью обычных функций, но использовать его вам никто не запрещает.
</p>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.arrayobject.php">Официальная документация</a></li>
</ul>
