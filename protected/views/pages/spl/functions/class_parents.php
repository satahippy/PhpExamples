<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'class_parents.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'class_parents')
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
    Возвращает список родительских классов. 
</p>
<p>
    Можно передать как объект, так и название класса. Может подгрузить описание класса автоматически (это поведение по умолчанию).
</p>

<h2>Пример</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
interface ITest1 {}
class TestParent1 implements ITest1 {}
class TestParent2 extends TestParent1 {}
class TestChild extends TestParent2 {}

$obj = new TestChild();
echo "object: " . implode(', ', class_parents($obj)) . "\n";
echo "class name: " . implode(', ', class_parents('TestChild')) . "\n";
]]></script>

<pre>
<?php
interface ITest1 {}
class TestParent1 implements ITest1 {}
class TestParent2 extends TestParent1 {}
class TestChild extends TestParent2 {}

$obj = new TestChild();
echo "object: " . implode(', ', class_parents($obj)) . "\n";
echo "class name: " . implode(', ', class_parents('TestChild')) . "\n";
?>
</pre>

<h2>Альтернатива</h2>
<p>
    На самом деле, это не единственный способ определить являет ли объект наследником какого то класса, как минимум вот ещё способы:
</p>
<ul>
    <li><code>instanceof</code></li>
    <li><code>is_a</code></li>
    <li><code>is_subclass_of</code></li>
    <li><code>get_parent_class</code></li>
    <li><code>ReflectionClass::isSubclassOf</code></li>
</ul>
<p>
    Что использовать решать вам, ведь всё зависит от задачи и от ваших личных предпочтений.
</p>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.class-parents.php">Официальная документация</a></li>
</ul>