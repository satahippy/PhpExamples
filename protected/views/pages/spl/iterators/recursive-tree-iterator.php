<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'RecursiveTreeIterator.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
        array('title' => 'RecursiveTreeIterator')
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
    Позволяет производить итерации над RecursiveIterator для генерации дерева в ASCII графике.
</blockquote>
<p>
    На самом деле не более чем утилитный класс. На каждой итерации добавляет свой префикс и суффикс к значению/ключу.
</p>
<p>
    Наследуется от <a href="recursive-iterator-iterator">RecursiveIteratorIterator</a> и внутри себя использует <a href="recursive-caching-iterator">RecursiveCachingIterator</a>.
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
]]></script>

<pre>
<?php
$arr = [
    'first',
    [
        'second',
        [
            'sf',
            'ss',
            [
                'st',
                [
                    'first',
                    'child1',
                    'child2',
                    'child3'
                ]
            ]
        ]
    ],
    'third'
];

$iterator = new RecursiveTreeIterator(new RecursiveArrayIterator($arr), null, null, RecursiveIteratorIterator::LEAVES_ONLY);

foreach ($iterator as $val) {
    echo "$val\n";
}
?>
</pre>

<h2>Флаги и т.п.</h2>
<p>
    Стоит рассмотреть аргументы конструктора:
</p>
<ol>
    <li>Итератор</li>
    <li>
        Флаги
        <ul>
            <li><code>BYPASS_CURRENT</code> - если указан, что то значение не будет оборачиваться</li>
            <li><code>BYPASS_KEY</code> - если указан, что то ключ не будет оборачиваться</li>
            <li><code>RecursiveIteratorIterator::CATCH_GET_CHILD</code> - флаг, который можно передать RecursiveIteratorIterator, читай подробнее <a href="recursive-iterator-iterator">тут</a></li>
        </ul>
    </li>
    <li>Флаги для итератора кэширования</li>
    <li>Режим работы RecursiveIteratorIterator</li>
</ol>

<h2>Префиксы</h2>
<p>
    Конечно же можно определить список префиксов с помощью <code>setPrefixPart</code>. Типа префикса передаётся первым аргументом, сам префикс - вторым. Всего их 6 штук:
</p>
<ul>
    <li><code>PREFIX_LEFT</code> - префикс для первого элемента</li>
    <li><code>PREFIX_MID_HAS_NEXT</code> - если есть следующий элемент и уровень вложенности меньше максимального</li>
    <li><code>PREFIX_MID_LAST</code> - если нет следующего элемента и уровень вложенности меньше максимального</li>
    <li><code>PREFIX_END_HAS_NEXT</code> - если есть следующий элемент и это последний уровень вложенности</li>
    <li><code>PREFIX_END_LAST</code> - если нет следующего элемента и это последний уровень вложенности</li>
    <li><code>PREFIX_RIGHT</code> - префикс перед любым элементом</li>
</ul>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
]]></script>

<pre>
<?php
$arr = [
    'first',
    [
        'second',
        [
            'sf',
            'ss',
            [
                'st',
                [
                    'first',
                    'child1',
                    'child2',
                    'child3'
                ]
            ]
        ]
    ],
    'third'
];

$iterator = new RecursiveTreeIterator(new RecursiveArrayIterator($arr), null, null, RecursiveIteratorIterator::LEAVES_ONLY);
$iterator->setPrefixPart(RecursiveTreeIterator::PREFIX_LEFT, 'a');
$iterator->setPrefixPart(RecursiveTreeIterator::PREFIX_MID_HAS_NEXT, 'b');
$iterator->setPrefixPart(RecursiveTreeIterator::PREFIX_MID_LAST, 'c');
$iterator->setPrefixPart(RecursiveTreeIterator::PREFIX_END_HAS_NEXT, 'd');
$iterator->setPrefixPart(RecursiveTreeIterator::PREFIX_END_LAST, 'e');
$iterator->setPrefixPart(RecursiveTreeIterator::PREFIX_RIGHT, 'f');

foreach ($iterator as $val) {
    echo "$val\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.recursivecachingiterator.php">Официальная документация</a></li>
</ul>