<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'RegexIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'RegexIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Реализация <a href="filter-iterator">FilterIterator</a>.
</p>
<p>
	Использует функции регулярных выражений для принятия решения о том, проходит элемент или нет.
</p>

<h2>Использование</h2>
<p>
	Простой пример. Проходят все элементы, которые содержат <b>i</b>.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new RegexIterator(new ArrayIterator(['first', 'second', 'third']), '/i/');
foreach ($it as $el) {
	echo "$el\n";
}
]]></script>

<pre>
<?php
$it = new RegexIterator(new ArrayIterator(['first', 'second', 'third']), '/i/');
foreach ($it as $el) {
	echo "$el\n";
}
?>
</pre>

<h2>Настройки</h2>
<p>
	Собственно для определения поведения есть 3 набора настроек:
</p>
<ul>
	<li>Режим работы (3 параметр конструктора + <code>setMode/getMode</code>)</li>
	<li>Флаги итератора (4 параметр конструктора + <code>setFlags/getFlags</code>)</li>
	<li>Флаги регулярного выражения (5 параметр конструктора + <code>setPregFlags/getPregFlags</code>)</li>
</ul>

<h3>Режим работы</h3>
<p>
	Тут у нас 5 флагов:
</p>
<ul>
	<li>
		<code>ALL_MATCHES</code> - в значение записываются все совпадения для текущей записи (используется
		<code>preg_match_all()</code>)
		<br/>
		<b>BEWARE!!!</b> При её использовании впринципе ничего не отсеется.
	</li>
	<li><code>GET_MATCH</code> - в значение записывается первое совпадение для текущей записи (используется
		<code>preg_match()</code>)
	</li>
	<li><code>MATCH</code> - просто провериться текущая запись по регулрке (используется <code>preg_match()</code>)</li>
	<li>
		<code>REPLACE</code> - производит замену в текущей записи (используется <code>preg_replace()</code>)
		<br/>
		Пока официально не поддерживается.
	</li>
	<li>
		<code>SPLIT</code> - записывает в значение разделённые значения для текущей записи (используется
		<code>preg_split()</code>)
	</li>
</ul>
<p>
	По умолчанию используется <code>MATCH</code>.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new RegexIterator(new ArrayIterator(['first', 'second', 'thirdie']), '/(.i.)/', RegexIterator::ALL_MATCHES);
foreach ($it as $el) {
	var_dump($el);
}
]]></script>

<pre>
<?php
$it = new RegexIterator(new ArrayIterator(['first', 'second', 'thirdie']), '/(.i.)/', RegexIterator::ALL_MATCHES);
foreach ($it as $el) {
	var_dump($el);
}
?>
</pre>

<h3>Флаги итератора</h3>
<p>
	На самом деле пока он всего один -
	<code>USE_KEY</code>. Позволяет использовать ключ вместо значения для работы регулярки.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new RegexIterator(new ArrayIterator(['first' => 'a', 'second' => 'b', 'third' => 'c']), '/i/');
$it->setFlags(RegexIterator::USE_KEY);
foreach ($it as $k => $v) {
	echo "$k: $v\n";
}
]]></script>

<pre>
<?php
$it = new RegexIterator(new ArrayIterator(['first' => 'a', 'second' => 'b', 'third' => 'c']), '/i/');
$it->setFlags(RegexIterator::USE_KEY);
foreach ($it as $k => $v) {
	echo "$k: $v\n";
}
?>
</pre>

<h3>Флаги регулярного выражения</h3>
<p>
	Возникает резонный вопрос: Откуда брать эти флаги? Ответ простой из информации по соответствующей функции.
</p>
<p>Как пример <code>preg_match_all</code>:</p>
<ul>
	<li><code>PREG_PATTERN_ORDER</code></li>
	<li><code>PREG_SET_ORDER</code></li>
	<li><code>PREG_OFFSET_CAPTURE</code></li>
</ul>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new RegexIterator(new ArrayIterator(['first', 'second', 'thirdie']), '/(.i.)/', RegexIterator::ALL_MATCHES);
$it->setPregFlags(PREG_OFFSET_CAPTURE);
foreach ($it as $el) {
	var_dump($el);
}
]]></script>

<pre>
<?php
$it = new RegexIterator(new ArrayIterator(['first', 'second', 'thirdie']), '/(.i.)/', RegexIterator::ALL_MATCHES);
$it->setPregFlags(PREG_OFFSET_CAPTURE);
foreach ($it as $el) {
	var_dump($el);
}
?>
</pre>

<h2>Замена (режим <code>REPLACE</code>)</h2>
<p>
	Хоть пока этот режим официально не поддерживается, но он всё же работает.
	<br/>
	Только для его работы надо указать свойство <code>replacement</code>.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new RegexIterator(new ArrayIterator(['first', 'second', 'thirdie']), '/(.i.)/', RegexIterator::REPLACE);
$it->replacement = '$1$1';
foreach ($it as $el) {
	var_dump($el);
}
]]></script>

<?php
$it = new RegexIterator(new ArrayIterator(['first', 'second', 'thirdie']), '/(.i.)/', RegexIterator::REPLACE);
$it->replacement = '$1$1';
foreach ($it as $el) {
	var_dump($el);
}
?>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.regexiterator.php">Официальная документация</a></li>
</ul>