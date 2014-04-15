<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'strip_tags/fgetss.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Экранирование символов и т.п.', 'url' => '/escaping/'),
	array('title' => 'strip_tags/fgetss')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>
<p>
	Удаляет все html и php теги и (внимание!) null-байты. Тем кто не знает, что такое null-байт и какие проблемы он может вызвать в php, прошу <a href="http://www.php.net/manual/ru/security.filesystem.nullbytes.php">сюда</a>.
	<br/>
	Позволяет указать список разрешённых тэгов.
	<br/>
	fgetss делает тоже самое, только читает данные из дескриптора ресурса (как fgets).
</p>
<p>
	Казалось бы функция очень удобна, но на самом деле она совершенно бесполезна. Вот некоторые из причин:
</p>
<ul>
	<li>Функция небезопасна и использовать её надо исключительно в тандеме с htmlspecialchars</li>
	<li>Не всегда корректно обрабатывает разрешённые тэги. Поэтому может не пропустить некоторые тэги</li>
	<li>Не проверяет валидность html. В связи с чем может удалить кучу нормального текста</li>
	<li>Никак не обрабатывает атрибуты разрешённых тэгов. Что может привести к XSS</li>
</ul>
<p>
	Всё это справедливо и для fgetss.
</p>

<h2>Альтернативы</h2>
<p>
	Если вам действительно нужно, чтобы пользовательский текст очищался от тэгов (полностью или частично) лучше всего воспользоваться готовой проверенной библиотекой (как пример - <a href="http://htmlpurifier.org/">HTML Purifier</a>).
</p>
<p>
	И тут желательно не изобретать велосипеды. Безопасность прежде всего!
</p>

<h2>Пример никчёмности</h2>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
	$html = '<img src="javascrip:xss()" />текст';
	$allowable = '<img>';
	file_put_contents('test.txt', $html);

	echo strip_tags($html, $allowable);

	$handle = @fopen('test.txt', 'r');
	if ($handle) {
		while (!feof($handle)) {
			$buffer = fgetss($handle, 4096, $allowable);
			echo $buffer;
		}
		fclose($handle);
	}
]]></script>
Результат
<script type="syntaxhighlighter" class="brush: php"><![CDATA[<?php
	ob_start();
	$html = '<img src="javascrip:xss()" />текст';
	$allowable = '<img>';
	file_put_contents('test.txt', $html);

	echo strip_tags($html, $allowable)."\n";

	$handle = @fopen('test.txt', 'r');
	if ($handle) {
		while (!feof($handle)) {
			$buffer = fgetss($handle, 4096, $allowable);
			echo $buffer;
		}
		fclose($handle);
	}
	echo htmlspecialchars(ob_get_clean());
?>]]></script>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://www.php.net/manual/ru/function.strip-tags.php">Официальная документация strip_tags</a></li>
	<li><a href="http://us1.php.net/manual/ru/function.fgetss.php">Официальная документация fgetss</a></li>
	<li><a href="http://htmlpurifier.org/">HTML Purifier</a></li>
</ul>