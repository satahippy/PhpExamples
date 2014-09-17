<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'class_implements.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'class_implements')
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
    Возвращает список реализуемых интерфейсов. 
</p>
<p>
    Можно передать как объект, так и название класса. Может подгрузить описание класса автоматически (это поведение по умолчанию).
</p>
<p>
    Определяет все реализуемые интерфейсы, включая интерфейсы родителей и т.д.
</p>

<h2>Пример</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
interface ITest1 {}
interface ITest2 extends ITest1 {}
interface ITest3 {}

class TestParent implements ITest2 {}
class TestChild extends TestParent implements ITest3 {}

$obj = new TestChild();
echo "object: " . implode(', ', class_implements($obj)) . "\n";
echo "class name: " . implode(', ', class_implements('TestChild')) . "\n";
]]></script>

<pre>
<?php
interface ITest1 {}
interface ITest2 extends ITest1 {}
interface ITest3 {}

class TestParent implements ITest2 {}
class TestChild extends TestParent implements ITest3 {}

$obj = new TestChild();
echo "object: " . implode(', ', class_implements($obj)) . "\n";
echo "class name: " . implode(', ', class_implements('TestChild')) . "\n";
?>
</pre>

<h2>Альтернатива</h2>
<p>
    На самом деле, это не единственный способ определить реализует ли объект интерфейс, как минимум вот ещё способы:
</p>
<ul>
    <li><code>instanceof</code></li>
    <li><code>is_a</code></li>
    <li><code>ReflectionClass::ImplementsInterface</code></li>
</ul>
<p>
    Что использовать решать вам, ведь всё зависит от задачи и от ваших личных предпочтений.
</p>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.class-implements.php">Официальная документация</a></li>
</ul>