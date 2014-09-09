<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'Countable.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Интерфейсы', 'url' => '/spl/interfaces/'),
        array('title' => 'Countable')
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
    Классы реализующие этот интерфейс могут быть использованы функцией <code>count</code>.
</p>
<p>
    Но дело в том, что сами массивы этот интерфейс не реализуют. Поэтому вы не можете использовать тайп хинтинг, если предполагаете, что возможна передача массива.
</p>

<h2>Пример реализации</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class SataArray implements Countable
{
    /**
     * @var mixed[]
     */
    private $array;

    /**
     * @param mixed[] $array
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->array);
    }
}

class SataCountPrinter
{
    /**
     * @param Countable $obj
     */
    public static function printCount(Countable $obj)
    {
        echo "count: " . count($obj) . "\n";
    }
}

$bar = new SataArray(['one', 'two', 'three']);
echo "inline count: " . count($bar) . "\n";

SataCountPrinter::printCount($bar);

// you can't do that
// SataCountPrinter::printCount(['one', 'two', 'three']);
]]></script>

<pre>
<?php

class SataArray implements Countable
{
    /**
     * @var mixed[]
     */
    private $array;

    /**
     * @param mixed[] $array
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->array);
    }
}

class SataCountPrinter
{
    /**
     * @param Countable $obj
     */
    public static function printCount(Countable $obj)
    {
        echo "count: " . count($obj) . "\n";
    }
}

$bar = new SataArray(['one', 'two', 'three']);
echo "inline count: " . count($bar) . "\n";

SataCountPrinter::printCount($bar);

// you can't do that
// SataCountPrinter::printCount(['one', 'two', 'three']);
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.countable.php">Официальная документация</a></li>
</ul>