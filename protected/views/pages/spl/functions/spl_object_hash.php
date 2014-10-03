<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'spl_object_hash.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Функции', 'url' => '/spl/functions/'),
        array('title' => 'spl_object_hash')
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
    Возвращает хэш объекта.
</p>
<p>
    С её помощью можно сделать альтернативу <a href="../datastructures/spl-object-storage">SplObjectStorage</a>, но делать этого не стоит. 
</p>

<h2>Особенности</h2>
<p>
    Хэш строится на основе внутреннего хранения объектов, и при удалении объекта сборщиком мусора его хэш может повторно использоваться. Это следует учитывать!
</p>

<h2>Пример</h2>
<p>
    Вот вам пример, как не надо использовать <code>spl_object_hash</code>.
    <br/>
    Будем делать штуку, которая будет фиксировать есть ли объект в нашем множестве или нет.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class Holder
{
    private $hashes = [];

    public function register($obj)
    {
        $hash = spl_object_hash($obj);
        if (!in_array($hash, $this->hashes)) {
            $this->hashes[] = $hash;
        }
    }

    public function has($obj)
    {
        $hash = spl_object_hash($obj);
        return in_array($hash, $this->hashes);
    }
}

$holder = new Holder();
$holder->register(new stdClass());
var_dump($holder->has(new stdClass()));
]]></script>

<pre>
<?php
class Holder
{
    private $hashes = [];

    public function register($obj)
    {
        $hash = spl_object_hash($obj);
        if (!in_array($hash, $this->hashes)) {
            $this->hashes[] = $hash;
        }
    }

    public function has($obj)
    {
        $hash = spl_object_hash($obj);
        return in_array($hash, $this->hashes);
    }
}

$holder = new Holder();
$holder->register(new stdClass());
var_dump($holder->has(new stdClass()));
?>
</pre>
<p>
    <code>has</code> вернул <code>true</code>, потому что первый <code>stdClass</code> освободил сборщик мусора и для второго использовался его хэш.
    <br/>
    Поэтому может показаться, что второй объект уже есть в регистраторе, но по факту его там нет.
</p>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/function.spl-object-hash.php">Официальная документация</a></li>
</ul>