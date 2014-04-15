<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'htmlentities.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'Экранирование символов и т.п.', 'url' => '/escaping/'),
	array('title' => 'htmlentities')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>
<p>
	Из официальной документации:
	<blockquote>Эта функция идентична htmlspecialchars() за исключением того, что htmlentities() преобразует все символы в соответствющие HTML-сущности (для тех символов, для которых HTML сущности существуют).</blockquote>
	И этим всё сказано.
</p>

<h2>В каких случаях использовать?</h2>
<p>На самом деле даже не могу придумать в каких... Наверное в каких то очень особенных. Поэтому можно смело на неё забить и использовать htmlspecialchars.</p>

<h2>htmlspecialchars vs htmlentities</h2>
<p>
	Впринципе тут всё и так ясно. htmlentities пытается заменить все символы на html сущности, в то время, как htmlspecialchars только <?php echo htmlspecialchars('&, \', ", <, >', ENT_QUOTES); ?>
</p>
<p>
	В связи с чем htmlspecialchars выигрывает в производительности (~ в 2.5 раза) + меньше данных передаётся клиенту (потому что 1 символ меньше 3 или больше)
</p>

<h2>Пример использования</h2>
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
	echo 'htmlentities: ' . htmlentities('what wrong with your ™£¢∞§¶?');
	echo 'htmlspecialchars: ' . htmlspecialchars('what wrong with your ™£¢∞§¶?');
]]></script>
Результат
<script type="syntaxhighlighter" class="brush: php"><![CDATA[
	<?php echo htmlspecialchars('htmlentities: ' . htmlentities('what wrong with your ™£¢∞§¶?')); ?>

	<?php echo htmlspecialchars('htmlspecialchars: ' . htmlspecialchars('what wrong with your ™£¢∞§¶?')); ?>
]]></script>



<h2>Чтиво:</h2>
<ul>
	<li><a href="http://www.php.net/manual/ru/function.htmlentities.php">Официальная документация htmlentities</a></li>
	<li><a href="http://www.php.net/manual/ru/function.htmlspecialchars.php">htmlspecialchars</a></li>
</ul>