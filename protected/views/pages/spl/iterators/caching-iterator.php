<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'CachingIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'CachingIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Обёртка для итераторов. Позволяет "кэшировать" результаты итерации.
</p>
<p>
	На самом деле эта штука ужасно описана в документации и у неё есть некоторые тонкости.
</p>

<h2>Как работает кэширование</h2>
<p>
	Всё кэширование заключается только в том, что запоминается результат методов <code>key</code>, <code>valid</code>,
	<code>current</code>.
	<br/>
	Таким образом, повторный вызов этих методов не вызывает повторного обращения к оригинальному итератору.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class TestIterator extends ArrayIterator
{
	public function current()
	{
		echo '(call original current)';
		return parent::current();
	}
}

$it = new CachingIterator(new TestIterator(['one', 'two', 'three']));
$it->rewind();
while ($it->valid()) {
	echo "{$it->current()} and again {$it->current()}\n";
	$it->next();
}
]]></script>
<pre>
<?php

class TestIterator extends ArrayIterator
{
	public function current()
	{
		echo '(call original current)';
		return parent::current();
	}
}

$it = new CachingIterator(new TestIterator(['one', 'two', 'three']));
$it->rewind();
while ($it->valid()) {
	echo "{$it->current()} and again {$it->current()}\n";
	$it->next();
}
?>
</pre>
<p>
	По сути не очень понятно, для чего вообще это может понадобиться, потому что подобного эффекта можно добиться, если просто завести соответствующие переменные. Именно так это работает в
	<code>foreach</code>.
</p>
<p>
	Но это вызвало побочный эффект в виде метода <code>hasNext</code>, за который и ценится этот итератор.
</p>
<p>
	Именно поэтому говорят, что на самом деле имя итератора вводит в заблуждение и его надо было назвать
	<code>LookAheadIterator</code>.
</p>

<h2><code>FULL_CACHE</code></h2>
<p>
	Это один из флагов, который определяет некоторые аспекты работы итератора.
	<br/>
	Он может ввести в заблуждение. Опять же, что кэшируется? Для чего это?
</p>
<p>
	С указанием этого флага вы получаете доступ к методу <code>getCache</code> - внутреннему кэшу итератора.
</p>
<p>
	Это самый обычный массив значений/ключей, которые обошёл итератор.
</p>
<p>
	Между прочим, этот итератор никак не используется самим <code>CachingIterator</code>.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new CachingIterator(new ArrayIterator(['one', 'two', 'three']), CachingIterator::FULL_CACHE);
$it->rewind();
$it->next();
var_dump($it->getCache());

foreach ($it as $el) ;
var_dump($it->getCache());
]]></script>
<pre>
<?php
$it = new CachingIterator(new ArrayIterator(['one', 'two', 'three']), CachingIterator::FULL_CACHE);
$it->rewind();
$it->next();
var_dump($it->getCache());

foreach ($it as $el) ;
var_dump($it->getCache());
?>
</pre>
<p>
	Немного о <code>rewind</code>. Наверняка вас смутил результат первого блока.
</p>
<p>
	Дело в том, что при вызове <code>rewind</code>, вызывается и
	<code>next</code>, что вызывает запись этого значения в кэш.
</p>
<p>
	Разумеется, при его вызове сбрасывается внутренний кэш.
</p>

<h2>ArrayAccess</h2>
<p>
	<code>CachingIterator</code> реализует интерфейс
	<a href="/built-in/array-access">ArrayAccess</a>, который позволяет обращаться к объекту в стиле массива.
</p>
<p>
	И доступ как ни странно, вы получается к внутреннему кэшу.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new CachingIterator(new ArrayIterator(['one', 'two', 'three']), CachingIterator::FULL_CACHE);

echo "--fill cache\n";
foreach ($it as $el) ;
var_dump($it->getCache());

echo "--change cache\n";
$it[3] = 'four';
unset($it[2]);
var_dump($it->getCache());

echo "--reset cache\n";
foreach ($it as $el) ;
var_dump($it->getCache());
]]></script>
<pre>
<?php
$it = new CachingIterator(new ArrayIterator(['one', 'two', 'three']), CachingIterator::FULL_CACHE);

echo "--fill cache\n";
foreach ($it as $el) ;
var_dump($it->getCache());

echo "--change cache\n";
$it[3] = 'four';
unset($it[2]);
var_dump($it->getCache());

echo "--reset cache\n";
foreach ($it as $el) ;
var_dump($it->getCache());
?>
</pre>

<h2>Фетиш вокруг <code>__toString</code></h2>
<p>
	Тоже неочень ясно, для чего это... Но вы можете определить поведение <code>__toString</code>:
</p>
<ul>
	<li><code>CALL_TOSTRING</code> - вызывает <code>__toString</code> текущего элемента или приводит его к строке</li>
	<li><code>TOSTRING_USE_KEY</code> - возвращает текущий ключ</li>
	<li><code>TOSTRING_USE_CURRENT</code> - возвращает текущее значение</li>
	<li><code>TOSTRING_USE_INNER</code> - возвращает оригинальный итератор</li>
</ul>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class Test
{
	protected $val;

	public function __construct($val)
	{
		$this->val = $val;
	}

	public function __toString()
	{
		return 'element ' . $this->val;
	}
}

class Test2Iterator extends ArrayIterator
{
	public function __toString()
	{
		return 'test iterator';
	}
}

$it = new CachingIterator(new Test2Iterator([new Test(1), new Test(2), new Test(3)]), CachingIterator::CALL_TOSTRING);
echo "--CALL_TOSTRING\n";
foreach($it as $el) {
	echo "$it\n";
}

$it = new CachingIterator(new Test2Iterator([new Test(1), new Test(2), new Test(3)]), CachingIterator::TOSTRING_USE_KEY);
echo "--TOSTRING_USE_KEY\n";
foreach($it as $el) {
	echo "$it\n";
}

$it = new CachingIterator(new Test2Iterator([1, 2, 3]), CachingIterator::TOSTRING_USE_CURRENT);
echo "--TOSTRING_USE_CURRENT\n";
foreach($it as $el) {
	echo "$it\n";
}

$it = new CachingIterator(new Test2Iterator([1, 2, 3]), CachingIterator::TOSTRING_USE_INNER);
echo "--TOSTRING_USE_INNER\n";
foreach($it as $el) {
	echo "$it\n";
}
]]></script>
<pre>
<?php

class Test
{
	protected $val;

	public function __construct($val)
	{
		$this->val = $val;
	}

	public function __toString()
	{
		return 'element ' . $this->val;
	}
}

class Test2Iterator extends ArrayIterator
{
	public function __toString()
	{
		return 'test iterator';
	}
}

$it = new CachingIterator(new Test2Iterator([new Test(1), new Test(2), new Test(3)]), CachingIterator::CALL_TOSTRING);
echo "--CALL_TOSTRING\n";
foreach($it as $el) {
	echo "$it\n";
}

$it = new CachingIterator(new Test2Iterator([new Test(1), new Test(2), new Test(3)]), CachingIterator::TOSTRING_USE_KEY);
echo "--TOSTRING_USE_KEY\n";
foreach($it as $el) {
	echo "$it\n";
}

$it = new CachingIterator(new Test2Iterator([1, 2, 3]), CachingIterator::TOSTRING_USE_CURRENT);
echo "--TOSTRING_USE_CURRENT\n";
foreach($it as $el) {
	echo "$it\n";
}

$it = new CachingIterator(new Test2Iterator([1, 2, 3]), CachingIterator::TOSTRING_USE_INNER);
echo "--TOSTRING_USE_INNER\n";
foreach($it as $el) {
	echo "$it\n";
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.cachingiterator.php">Официальная документация</a></li>
	<li>
		<a href="http://blog.calevans.com/2013/12/19/the-php-cachingiterator/comment-page-1/#comment-110609">Мэн отлично описал внутренне устройство CachingIterator</a></li>
</ul>