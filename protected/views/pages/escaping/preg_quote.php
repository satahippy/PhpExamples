<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'preg_quote & quotemeta.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Экранирование символов и т.п.', 'url' => '/escaping/'),
	array('title' => 'preg_quote & quotemeta')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>
<p>
	Обе функции экранирует спец символы в регулярках.
	<br/>
	preg_quote в PCRE
	<br/>
	quotemeta в POSIX
</p>

<h2>Для чего?</h2>
<p>
	Это на тот случай, когда регулярка, частично или полностью, состоит из строки, которую мы не контролируем (etc. пользовательский ввод).
</p>

<h2>Сравнение preg_quote(PCRE) и quotemeta(POSIX)</h2>
<p>
	Вообще PCRE наверное популярнее POSIX'а. Да и POSIX уже считается устаревшим в php. Но тут рассмотрим только различие этих функций.
</p>
<ol>
	<li>preg_quote позволяет указать разделитель, который используется для обозначения регулярного выражения</li>
	<li>quotemeta на самом деле экранирует не все спец символы POSIX</li>
</ol>
<p>
	Думаю, суммируя всё это, quotemeta будет использоваться редко. Только если в старых проектах.
</p>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://www.php.net/manual/ru/function.preg-quote.php">Официальная документация preg_quote</a></li>
	<li><a href="http://www.php.net/manual/ru/function.quotemeta.php">Официальная документация quotemeta</a></li>
</ul>