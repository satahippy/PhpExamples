<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'MultipleIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'MultipleIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Сначала может показаться, что он чем то похож на
	<a href="append-iterator">AppendIterator</a>. Но на самом деле это не так.
</p>
<p>
	Собственно, что он делает. Он перебирает несколько итераторов одновременно. На примере это будет выглядеть наглядно.
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new MultipleIterator();
$it->attachIterator(new ArrayIterator(['php', 'python', 'c#']));
$it->attachIterator(new ArrayIterator(['mysql', 'mongodb', 'mssql']));

foreach ($it as $val) {
	$key = $it->key();
	echo implode(', ', $key) . ': ' . implode(', ', $val) . "\n";
}
]]></script>

<pre>
<?php
$it = new MultipleIterator();
$it->attachIterator(new ArrayIterator(['php', 'python', 'c#']));
$it->attachIterator(new ArrayIterator(['mysql', 'mongodb', 'mssql']));

foreach ($it as $val) {
	$key = $it->key();
	echo implode(', ', $key) . ': ' . implode(', ', $val) . "\n";
}
?>
</pre>

<p>
	Тут есть один интересный момент. Дело в том, что значения и ключи возвращаются в виде массивов.
	<br/>
	Т.е. текущий ключ есть массив текущих ключей внутренних итераторов. Так же ведут себя и значения. 
</p>
<p>
	Но смысл в том, что ключ в <code>foreach</code> может быть только либо целочисленным, либо строкой.
	<br/>
	Поэтому доступ к ключам происходит с помощью: <code>$key = $it->key()</code>.
</p>

<h2>Флаги перебора</h2>
<p>
	Резонный вопрос: что будет, если у итераторов будет разная длина? Для управления этим поведением есть 2 флага:
</p>
<ul>
	<li><code>MIT_NEED_ALL</code> - требуется, чтобы все внутренние итераторы были валидными, иначе - перебор заканчивается</li>
	<li><code>MIT_NEED_ANY</code> - требуется, чтобы хотя бы один внутренний итератор был валидным</li>
</ul>
<p>
	<code>MIT_NEED_ALL</code> - используется по дефолту.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new MultipleIterator(MultipleIterator::MIT_NEED_ALL);
$it->attachIterator(new ArrayIterator(['php', 'python', 'c#']));
$it->attachIterator(new ArrayIterator(['mysql', 'mongodb']));

echo "MultipleIterator::MIT_NEED_ALL\n";
foreach ($it as $val) {
	var_dump($val);
}

echo "MultipleIterator::MIT_NEED_ANY\n";
$it->setFlags(MultipleIterator::MIT_NEED_ANY);
foreach ($it as $val) {
	var_dump($val);
}
]]></script>

<pre>
<?php
$it = new MultipleIterator(MultipleIterator::MIT_NEED_ALL);
$it->attachIterator(new ArrayIterator(['php', 'python', 'c#']));
$it->attachIterator(new ArrayIterator(['mysql', 'mongodb']));

echo "MultipleIterator::MIT_NEED_ALL\n";
foreach ($it as $val) {
	var_dump($val);
}

echo "MultipleIterator::MIT_NEED_ANY\n";
$it->setFlags(MultipleIterator::MIT_NEED_ANY);
foreach ($it as $val) {
	var_dump($val);
}
?>
</pre>

<h2>Флаги ключей</h2>
<p>
	По умолчанию, ключи будут соответствовать позиции итератора, позиция раздаётся по порядку. Но это можно изменить:
</p>
<ul>
	<li><code>MIT_KEYS_NUMERIC</code> - как раз поведение по умолчанию</li>
	<li><code>MIT_KEYS_ASSOC</code> - ключи соответствуют дополнительной информации, которая указывается в <code>attachIterator</code></li>
</ul>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new MultipleIterator(MultipleIterator::MIT_KEYS_NUMERIC);
$it->attachIterator(new ArrayIterator(['php', 'python', 'c#']), 'languages');
$it->attachIterator(new ArrayIterator(['mysql', 'mongodb']), 'databases');

echo "MultipleIterator::MIT_KEYS_NUMERIC\n";
foreach ($it as $val) {
	$key = $it->key();
	var_dump($key);
}

echo "MultipleIterator::MIT_KEYS_ASSOC\n";
$it->setFlags(MultipleIterator::MIT_KEYS_ASSOC);
foreach ($it as $val) {
	$key = $it->key();
	var_dump($key);
}
]]></script>

<pre>
<?php
$it = new MultipleIterator(MultipleIterator::MIT_KEYS_NUMERIC);
$it->attachIterator(new ArrayIterator(['php', 'python', 'c#']), 'languages');
$it->attachIterator(new ArrayIterator(['mysql', 'mongodb']), 'databases');

echo "MultipleIterator::MIT_KEYS_NUMERIC\n";
foreach ($it as $val) {
	$key = $it->key();
	var_dump($key);
}

echo "MultipleIterator::MIT_KEYS_ASSOC\n";
$it->setFlags(MultipleIterator::MIT_KEYS_ASSOC);
foreach ($it as $val) {
	$key = $it->key();
	var_dump($key);
}
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.multipleiterator.php">Официальная документация</a></li>
</ul>