<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'addslashes/addcslashes.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Экранирование символов и т.п.', 'url' => '/escaping/'),
	array('title' => 'addslashes/addcslashes')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>
<p>
	Экранирует слэшами
</p>

<h2>Где использовать?</h2>
<p>
	Очень редко эта функция может понадобиться. Иногда пишут, что её надо использовать при работе с базой данных. Никогда её не используйте в этих целях!
</p>
<p>
	С тех пор как появился <a href="http://www.php.net/manual/ru/book.pdo.php">PDO</a> с его <a href="http://www.php.net/manual/ru/pdo.prepared-statements.php">Prepared Statements</a> можно забыть о всех экранирующих функциях при работе с бд.
</p>
<p>
	Но даже если вы не пользуетесь PDO, php предоставляет много функций для экранирования при работе с бд. Так что addslashes это последний вариант.
</p>
<p>
	Тем не менее функция бывает полезной в особенных случаях. Как пример - передачи строки в js переменную. На самом деле плохой, есть другие способы для передачи данных в js. Например, json.
</p>

<h2>Пример</h2>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
	function javascriptQuote($string)
	{
		return addcslashes($string, "\r\t\n'\"\\");
	}
	echo 'var message = '. javascriptQuote("Привет митсер \"O'Reilly\".\nКак ваши дела?\n\tПлохо\\Хорошо");
]]></script>
Результат
<script type="syntaxhighlighter" class="brush: php"><![CDATA[<?php
	ob_start();
	function javascriptQuote($string)
	{
		return addcslashes($string, "\r\t\n'\"\\");
	}
	echo 'var message = "'. javascriptQuote("Привет митсер \"O'Reilly\".\nКак ваши дела?\n\tПлохо\\Хорошо").'"';
	echo htmlspecialchars(ob_get_clean());
?>]]></script>

<h2>addslashes vs addcslashes</h2>
<p>
	addcslashes позволяет указать символы, которые надо экранировать.
	<br/>
	addslashes экранирует <?php echo htmlspecialchars('\', ", \\'); ?> и Null-байт.
</p>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://www.php.net/manual/ru/function.addslashes.php">Официальная документация addslashes</a></li>
	<li><a href="http://www.php.net/manual/ru/function.addcslashes.php">Официальная документация addcslashes</a></li>
</ul>