<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'RecursiveCallbackFilterIterator.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
        array('title' => 'RecursiveCallbackFilterIterator')
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
    Делает тоже самое, что и <a href="callback-filter-iterator">CallbackFilterIterator</a>, только рекурсивно.
</p>
<p>
    В официальной документации ещё говорится, что колбэк должен пропускать рекурсию, т.е. если итератор имеет дочерние элементы, то его надо пропускать. Но всё зависит от вашего желания.
</p>

<h2>Использование</h2>
<p>
    Будем исключать из итерации элементы по блэк листу, будь то ключ или значение.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$arr = [
    'first',
    'second' => [
        'sf',
        'ss',
        'st' => [
            'first',
            'child1',
            'child2',
            'child3'
        ]
    ],
    'third'
];
$blackList = ['st', 'first'];

$callback = function ($current, $key, $iterator) use ($blackList) {
    if (!$iterator->hasChildren() && in_array($current, $blackList)) {
        return false;
    }

    if ($iterator->hasChildren() && in_array($key, $blackList)) {
        return false;
    }
    
    return true;
};

$iterator = new RecursiveIteratorIterator(new RecursiveCallbackFilterIterator(new RecursiveArrayIterator($arr), $callback), RecursiveIteratorIterator::SELF_FIRST);

foreach ($iterator as $key => $val) {
    if (!$iterator->callHasChildren()) {
        $text = $val;
    } else {
        $text = $key;
    }
    echo str_repeat("\t", $iterator->getDepth()) . "$text\n";
}
]]></script>

<pre>
<?php
$arr = [
    'first',
    'second' => [
        'sf',
        'ss',
        'st' => [
            'first',
            'child1',
            'child2',
            'child3'
        ]
    ],
    'third'
];
$blackList = ['st', 'first'];

$callback = function ($current, $key, $iterator) use ($blackList) {
    if (!$iterator->hasChildren() && in_array($current, $blackList)) {
        return false;
    }

    if ($iterator->hasChildren() && in_array($key, $blackList)) {
        return false;
    }
    
    return true;
};

$iterator = new RecursiveIteratorIterator(new RecursiveCallbackFilterIterator(new RecursiveArrayIterator($arr), $callback), RecursiveIteratorIterator::SELF_FIRST);

foreach ($iterator as $key => $val) {
    if (!$iterator->callHasChildren()) {
        $text = $val;
    } else {
        $text = $key;
    }
    echo str_repeat("\t", $iterator->getDepth()) . "$text\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.recursivecallbackfilteriterator.php">Официальная документация</a></li>
</ul>