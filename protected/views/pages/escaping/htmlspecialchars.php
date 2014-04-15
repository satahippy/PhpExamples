<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'htmlspecialchars.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Экранирование символов и т.п.', 'url' => '/escaping/'),
	array('title' => 'htmlspecialchars')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>
<p>
	Функция преобразует некоторые спец симовлы (<?php echo htmlspecialchars('&, \', ", <, >', ENT_QUOTES); ?>) в эквивалентные им html сущности.
	<br/>
	<a href="http://www.php.net/manual/ru/function.htmlentities.php">Официальная документация</a>
</p>
<p>
	Для управления поведением работы функции используюся специальные флаги.
</p>

<h2>Поведение по умолчанию</h2>
<p>По умолчанию не трогает одинарные ковычки.</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
	htmlspecialchars('<b>Here</b> is quotes \' & "');
]]></script>
Результат
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
	<?php echo htmlspecialchars(htmlspecialchars('<b>Here</b> is quotes \' & "')); ?>
]]></script>

<h2>Обработка некорректных кодовых последовательностей</h2>
<p>По умолчалнию при наличии таковых возвращается просто пустая строка.</p>
<p>
	Флаги ENT_IGNORE и ENT_SUBSTITUTE.
	<br/>
	При использовании ENT_IGNORE отбросит такие последовательности (и не вызовет никакого исключения/предупреждения). Не рекомендуется использовать, потому что это потенциальная дыра для XSS атак.
	<br/>
	При использовании ENT_SUBSTITUTE заменит их на символы замены Unicode (значки вопроса). Наверное это предпочтительный вариант.
</p>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
	var_dump(htmlspecialchars("a\x80b"));
	var_dump(htmlspecialchars("a\x80b", ENT_IGNORE));
	var_dump(htmlspecialchars("a\x80b", ENT_SUBSTITUTE));
]]></script>
Результат
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
	<?php var_dump(htmlspecialchars("a\x80b")); ?>
	<?php var_dump(htmlspecialchars("a\x80b", ENT_IGNORE)); ?>
	<?php var_dump(htmlspecialchars("a\x80b", ENT_SUBSTITUTE)); ?>
]]></script>

<h2>Разное</h2>
<p>Третьим параметорм функции вы можете указать кодировку для обработки строки. Список поддерживаемых кодировок смотри на оф. сайте</p>
<p>Четвёртым параметром можно указать не преоброзовывать уже существующие html сущности. Это может быть полезно, если вы прогоняете строку (или какую то её часть) нексолько раз. Хотя это такая редкость)</p>
<?php
$text = '<b>Html текст</b>';
$text2 = '<b>Html текст</b>';
for ($i = 0; $i < 5; $i++) {
	$text = htmlspecialchars($text);
	$text2 = htmlspecialchars($text2, ENT_COMPAT | ENT_HTML401, 'UTF-8', false);
}
echo $text.'<br/>'.$text2;
?>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
	$text = '<b>Html текст</b>';
	$text2 = '<b>Html текст</b>';
	for ($i = 0; $i < 5; $i++) {
		$text = htmlspecialchars($text);
		$text2 = htmlspecialchars($text2, ENT_COMPAT | ENT_HTML401, 'UTF-8', false);
	}
	echo "$text\n$text2";
]]></script>
Результат
<script type="syntaxhighlighter" class="brush: php"><![CDATA[<?php
		$text = '<b>Html текст</b>';
		$text2 = '<b>Html текст</b>';
		for ($i = 0; $i < 5; $i++) {
			$text = htmlspecialchars($text);
			$text2 = htmlspecialchars($text2, ENT_COMPAT | ENT_HTML401, 'UTF-8', false);
		}
		echo "$text\n$text2";
?>]]></script>

<h2>XSS</h2>
<p>Считается, что эта функция защищает от любого типа XSS. Но это не всегда так. Надо прояснить некоторые моменты.</p>
<p>
	Предположим у нас есть код
	<script type="syntaxhighlighter" class="brush: php"><![CDATA[
		$title = htmlspecialchars($title);
		echo "<a title='$title'>Here i am!</a>"]]></script>
	Тут у нас возникнут проблемы, если $title будет чем то вроде ' href='javascript:alert(document.cookie)'. В результате мы получим:
	<script type="syntaxhighlighter" class="brush: php"><![CDATA[<a title='' href='javascript:alert(document.cookie)'>Here i am!</a>]]></script>
	С этим справиться достаточно легко, тут достаточно использовать флаг ENT_QUOTES. Можно конечно во всех аттрибутах использовать только двойные кавычки, но для совсем упоротых.
</p>
<p>
	Но есть ситуации и похуже.
	<script type="syntaxhighlighter" class="brush: php"><![CDATA[
		$link = htmlspecialchars($link);
		echo "<a href='$link'>Here i am!</a>"]]></script>
	И тут нам уже ничто не поможет, потому что строку типа javascript:alert(document.cookie) htmlspecialchars (и ей подобные) вообще никак не обработают. И получится у нас:
	<script type="syntaxhighlighter" class="brush: php"><![CDATA[<a href='javascript:alert(document.cookie)'>Here i am!</a>]]></script>
	Как с этим бороться? Просто не допускать подобных ситуаций. Но если нечто подобное необходимо (richtext как пример), нужно прибегать к более серьёзным инструментам.
	<br/>
	Причём здесь, лучше не прибегать к собственным велосипедам, потому что есть как минимум <a href="http://htmlpurifier.org/">HTML Purifier</a>.
</p>

<h2>Чтиво:</h2>
<ul>
	<li><a href="http://www.php.net/manual/ru/function.htmlentities.php">Официальная документация htmlentities</a></li>
	<li><a href="http://habrahabr.ru/post/137296/">Изменения в PHP 5.4</a></li>
</ul>