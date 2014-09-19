<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'class_uses.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'class_uses')
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
    Возвращает список используемых трейтов. 
</p>
<p>
    Можно передать как объект, так и название класса. Может подгрузить описание класса автоматически (это поведение по умолчанию).
</p>

<h2>Пример</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
trait Trait1 { }
trait Trait2 { }
class TestClass { use Trait1, Trait2; }

$obj = new TestClass();
echo "object: " . implode(', ', class_uses($obj)) . "\n";
echo "class name: " . implode(', ', class_uses('TestClass')) . "\n";
]]></script>

<pre>
<?php
trait Trait1 { }
trait Trait2 { }
class TestClass { use Trait1, Trait2; }

$obj = new TestClass();
echo "object: " . implode(', ', class_uses($obj)) . "\n";
echo "class name: " . implode(', ', class_uses('TestClass')) . "\n";
?>
</pre>

<h2>Особенности</h2>
<p>
    В отличие от <a href="class_implements">class_implements</a> и <a href="class_parents">class_parents</a>, <code>class_uses</code> не проводит глубокого анализа.
</p>
<p>
    Т.е. возвращаются трейты только текущего класса.
</p>
<p>
    <a href="http://php.net/manual/ru/function.class-uses.php#110752">Тут</a> приведена реализации глубокого <code>class_uses</code>.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class TestParent1 { use Trait1; }
class TestParent2 extends TestParent1 { use Trait2; }
class TestChild extends TestParent2 {}

echo "simple: " . implode(', ', class_uses('TestChild')) . "\n";
echo "deep: " . implode(', ', class_uses_deep('TestChild')) . "\n";
]]></script>

<pre>
<?php
function class_uses_deep($class, $autoload = true)
{
    $traits = [];
    do {
        $traits = array_merge(class_uses($class, $autoload), $traits);
    } while ($class = get_parent_class($class));
    foreach ($traits as $trait => $same) {
        $traits = array_merge(class_uses($trait, $autoload), $traits);
    }
    return array_unique($traits);
}

class TestParent1 { use Trait1; }
class TestParent2 extends TestParent1 { use Trait2; }
class TestChild extends TestParent2 {}

echo "simple: " . implode(', ', class_uses('TestChild')) . "\n";
echo "deep: " . implode(', ', class_uses_deep('TestChild')) . "\n";
?>
</pre>

<h2>Альтернатива</h2>
<p>
    На самом деле, это не единственный способ получить трейты класса, как минимум вот ещё способы:
</p>
<ul>
    <li><code>get_declared_traits</code></li>
    <li><code>ReflectionClass::getTraits</code></li>
</ul>
<p>
    Что использовать решать вам, ведь всё зависит от задачи и от ваших личных предпочтений.
</p>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.class-uses.php">Официальная документация</a></li>
    <li><a href="http://php.net/manual/ru/function.class-uses.php#110752">Реализация глубокого class_uses</a></li>
</ul>