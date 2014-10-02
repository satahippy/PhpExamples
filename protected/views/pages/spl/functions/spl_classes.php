<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'spl_classes.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'spl_classes')
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
    Возвращает список всех доступных на данный момент классов SPL.
</p>
<p>
    Будет полезна, если хотите поддерживать обратную совместимость. 
</p>

<h2>Пример</h2>
<p>
    Будем проверять, если нам доступен <a href="../iterators/recursive-iterator-iterator">RecursiveIteratorIterator</a>, то выводить результат итерации будем с помощью него, иначе другим способом.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class IteratorPrinter
{
    public static function printIterator(RecursiveIterator $it)
    {
        if (in_array('RecursiveIteratorIterator', spl_classes())) {
            echo "--IteratorIterator\n";
            static::printIteratorIterator(new RecursiveIteratorIterator($it, RecursiveIteratorIterator::SELF_FIRST));
        } else {
            echo "--RecursiveIterator\n";
            static::printRecursiveIterator($it);
        }
    }

    private static function printIteratorIterator(RecursiveIteratorIterator $it)
    {
        foreach ($it as $key => $val) {
            if (!$it->callHasChildren()) {
                $text = $val;
            } else {
                $text = $key;
            }
            echo str_repeat("\t", $it->getDepth())."$text\n";
        }
    }

    private static function printRecursiveIterator(RecursiveIterator $it, $step = 0)
    {
        $it->rewind();
        while ($it->valid()) {
            if ($it->hasChildren()) {
                echo str_repeat("\t", $step) . $it->key() . "\n";
                static::printRecursiveIterator($it->getChildren(), $step + 1);
            } else {
                echo str_repeat("\t", $step) . $it->current() . "\n";
            }
            $it->next();
        }
    }
}

$arr = [
    'first',
    'second' => [
        'sf',
        'ss',
        'st' => [
            'child1',
            'child2',
            'child3'
        ]
    ],
    'third'
];
IteratorPrinter::printIterator(new RecursiveArrayIterator($arr));
]]></script>

<pre>
<?php
class IteratorPrinter
{
    public static function printIterator(RecursiveIterator $it)
    {
        if (in_array('RecursiveIteratorIterator', spl_classes())) {
            echo "--IteratorIterator\n";
            static::printIteratorIterator(new RecursiveIteratorIterator($it, RecursiveIteratorIterator::SELF_FIRST));
        } else {
            echo "--RecursiveIterator\n";
            static::printRecursiveIterator($it);
        }
    }

    private static function printIteratorIterator(RecursiveIteratorIterator $it)
    {
        foreach ($it as $key => $val) {
            if (!$it->callHasChildren()) {
                $text = $val;
            } else {
                $text = $key;
            }
            echo str_repeat("\t", $it->getDepth())."$text\n";
        }
    }

    private static function printRecursiveIterator(RecursiveIterator $it, $step = 0)
    {
        $it->rewind();
        while ($it->valid()) {
            if ($it->hasChildren()) {
                echo str_repeat("\t", $step) . $it->key() . "\n";
                static::printRecursiveIterator($it->getChildren(), $step + 1);
            } else {
                echo str_repeat("\t", $step) . $it->current() . "\n";
            }
            $it->next();
        }
    }
}

$arr = [
    'first',
    'second' => [
        'sf',
        'ss',
        'st' => [
            'child1',
            'child2',
            'child3'
        ]
    ],
    'third'
];
IteratorPrinter::printIterator(new RecursiveArrayIterator($arr));
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.spl-classes.php">Официальная документация</a></li>
</ul>