<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'RecursiveRegexIterator.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
        array('title' => 'RecursiveRegexIterator')
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
    Реализация <a href="recursive-filter-iterator">RecursiveFilterIterator</a>.
</p>
<p>
    Делает тоже самое, что и <a href="regex-iterator">RegexIterator</a>, только рекурсивно.
</p>

<h2>Использование</h2>
<p>
    Заметьте, что каждый текущий элемент как значение (<code>current()</code>) должен отдавать либо строку, либо что то к ней приводящееся.
</p>
<p>
    Т.е. с <a href="recursive-array-iterator">RecursiveArrayIterator</a> будет проблематично при этом работать, потому что некоторые элементы возвращают массив как текущее значение (которые имеют дочерние элементы).
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new RecursiveIteratorIterator(new RecursiveRegexIterator(new RecursiveDirectoryIterator(__DIR__ . '/test'), '/ss/i'));

foreach ($it as $dir) {
    echo "$dir\n";
}
]]></script>

<pre>
<?php
$it = new RecursiveIteratorIterator(new RecursiveRegexIterator(new RecursiveDirectoryIterator(__DIR__ . '/test'), '/ss/i'));

foreach ($it as $dir) {
    echo "$dir\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.recursiveregexiterator.php">Официальная документация</a></li>
</ul>