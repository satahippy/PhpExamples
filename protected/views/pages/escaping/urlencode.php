<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'urlencode/rawurlencode.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Экранирование символов и т.п.', 'url' => '/escaping/'),
	array('title' => 'urlencode/rawurlencode')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>
<p>
	Кодирует строку для url
</p>

<h2>Для чего это надо?</h2>
<p>
	Если вы хотите что то передать как параметр url.
</p>
<p>
	Т.е. если у вас есть строка - "Привет Guns&Roses. Пишу вам из вечно холодной России. Когда вы уже наконец приедете к нам в Иркутск?".
	<br/>
	Он её закодирует так, чтобы она передалась без проблем.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
	$message = 'Привет Guns&Roses. Пишу вам из вечно холодной России. Когда вы уже наконец приедете к нам в Иркутск?';
	echo 'http://gunsnroses.com/write?message=' . rawurlencode($message);
]]></script>
Результат
<script type="syntaxhighlighter" class="brush: php"><![CDATA[<?php
	ob_start();
	$message = 'Привет Guns&Roses. Пишу вам из вечно холодной России. Когда вы уже наконец приедете к нам в Иркутск?';
	echo 'http://gunsnroses.com/write?message=' . rawurlencode($message);
	echo htmlspecialchars(ob_get_clean());
?>]]></script>

<h2>urlencode vs rawurlencode</h2>
<p>
	Разница только в одном: rawurlencode кодирует соответственно RFC 3986.
	<br/>
	А по существу urlencode кодирует пробел знаком +, а rawurlencode как надо - %20.
	<br/>
	Почему? Это история. Если нужно больше информации <a href="http://stackoverflow.com/questions/996139/urlencode-vs-rawurlencode/6998242#6998242">вот</a> вам достаточно исчерпывающая информация.
</p>
<p>
	Так а что использовать? Используйте rawurlencode, не ошибётесь.
</p>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://www.php.net/manual/ru/function.urlencode.php">Официальная документация urlencode</a></li>
	<li><a href="http://www.php.net/manual/ru/function.rawurlencode.php">Официальная документация rawurlencode</a></li>
	<li><a href="http://stackoverflow.com/questions/996139/urlencode-vs-rawurlencode/6998242#6998242">urlencode vs rawurlencode</a></li>
</ul>