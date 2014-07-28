<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'CallbackFilterIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'CallbackFilterIterator')
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
	В принципе ничего нового он не делает, просто вместо того чтобы реализовывать метод <code>accept</code> вы передаёте функцию, которая будет проверять элемент в конструкторе. 
</p>
<p>
	Эта функция может принимать в качестве аргументов: текущее значение, текущий ключ и итератор. 
</p>
<p>
	Ну вообще под функцией имеется ввиду что либо <a href="http://php.net/manual/ru/language.types.callable.php">вызываемое</a>. Callback в народе. 
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$censoredSpeech = new CallbackFilterIterator(new ArrayIterator(['bla-bla-bla', 'what?', 'shut up!']), function($value){
	if (strlen($value) > 10) {
		return false;
	}
	return true;
});

foreach ($censoredSpeech as $phrase) {
	echo "$phrase\n";
}
]]></script>

<pre>
<?php

$censoredSpeech = new CallbackFilterIterator(new ArrayIterator(['bla-bla-bla', 'what?', 'shut up!']), function($value){
	if (strlen($value) > 10) {
		return false;
	}
	return true;
});

foreach ($censoredSpeech as $phrase) {
	echo "$phrase\n";
}

?>
</pre>
<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.callbackfilteriterator.php">Официальная документация</a></li>
	<li><a href="filter-iterator">FilterIterator</a></li>
</ul>