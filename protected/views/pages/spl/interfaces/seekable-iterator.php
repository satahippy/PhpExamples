<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'SeekableIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Интерфейсы', 'url' => '/spl/interfaces/'),
	array('title' => 'SeekableIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
	Интерфейс для итераторов, которые можно проматывать до нужной позиции.
</p>

<h2>Пример реализации</h2>
<p>
	Это будет итератор, который перебирает буквы в строке.
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class LettersIterator implements SeekableIterator
{
	protected $text;
	protected $position;

	public function __construct($text)
	{
		$this->text = $text;
		$this->position = 0;
	}

	function rewind()
	{
		$this->position = 0;
	}

	function current()
	{
		return $this->text[$this->position];
	}

	function key()
	{
		return $this->position;
	}

	function next()
	{
		++$this->position;
	}

	function valid()
	{
		return $this->position < strlen($this->text);
	}

	public function seek($position)
	{
		$this->position = $position;
	}
}

$letters = new LettersIterator('vodka');
foreach ($letters as $letter) {
	echo $letter . "\n";
}

$letters->seek(2);
echo $letters->key() . ': ' . $letters->current();
]]></script>

<pre>
<?php

class LettersIterator implements SeekableIterator
{
	protected $text;
	protected $position;

	public function __construct($text)
	{
		$this->text = $text;
		$this->position = 0;
	}

	function rewind()
	{
		$this->position = 0;
	}

	function current()
	{
		return $this->text[$this->position];
	}

	function key()
	{
		return $this->position;
	}

	function next()
	{
		++$this->position;
	}

	function valid()
	{
		return $this->position < strlen($this->text);
	}

	public function seek($position)
	{
		$this->position = $position;
	}
}

$letters = new LettersIterator('vodka');
foreach ($letters as $letter) {
	echo $letter . "\n";
}

$letters->seek(2);
echo $letters->key() . ': ' . $letters->current();
?>
</pre>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.seekableiterator.php">Официальная документация</a></li>
</ul>