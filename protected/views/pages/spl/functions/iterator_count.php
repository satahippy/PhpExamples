<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'iterator_count.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'iterator_count')
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
<blockquote>
    Подсчитывает количество элементов в итераторе
</blockquote>

<h2>Пример</h2>
<p>
    Пример показывает, что подсчёт идёт с помощью перебора итератора.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class TestIterator extends ArrayIterator
{
    public function next()
    {
        echo "next\n";
        parent::next();
    }
}

echo iterator_count(new TestIterator(['one', 'two', 'three']))."\n";
]]></script>

<pre>
<?php
class TestIterator extends ArrayIterator
{
    public function next()
    {
        echo "next\n";
        parent::next();
    }
}

echo iterator_count(new TestIterator(['one', 'two', 'three']))."\n";
?>
</pre>

<h2>Недостатки</h2>

<h3>Подсчёт идёт простым перебором.</h3>
<p>
    Т.е. просто последовательно вызывается <code>next</code> до тех пор, пока <code>valid</code> не вернёт <code>false</code>.
    <br/>
    И даже <a href="../interfaces/countable">Countable</a> тут не поможет.
</p>
<p>
    Чем же это плохо? Дело в том, что если ваш итератор имеет побочные эффекты (например отправляется почта)), то они неявно будут иметь место. 
</p>

<h3>Итератор не приводится к первоначальному состоянию</h3>
<p>
    Он перебирается и даже не откатывается назад. И если вы вздумаете вызвать его в процессе перебора того же итератора, то ваш перебор просто закончится.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new ArrayIterator(['one', 'two', 'three']);
foreach ($it as $val) {
    echo $val . ': ' . iterator_count($it) . "\n";
}
]]></script>

<pre>
<?php
$it = new ArrayIterator(['one', 'two', 'three']);
foreach ($it as $val) {
    echo $val . ': ' . iterator_count($it) . "\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.iterator-count.php">Официальная документация</a></li>
</ul>