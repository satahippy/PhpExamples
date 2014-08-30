<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'RecursiveDirectoryIterator.');
$view['slots']->set('breadcrumbs', array(
	array('title' => 'SPL', 'url' => '/spl/'),
	array('title' => 'Итераторы', 'url' => '/spl/iterators/'),
	array('title' => 'RecursiveDirectoryIterator')
));
echo $view->render('partials/syntax_highlighter.php', array(
	'brushes' => array('Php')
));
?>

<h2>Описание</h2>
<p>
    То же самое, что и <a href="filesystem-iterator">FilesystemIterator</a>, только рекурсивный.
</p>
<p>
    Пожалуй самый полезный итератор для обхода файловой системы.
</p>

<h2>Использование</h2>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/test', FilesystemIterator::KEY_AS_FILENAME | FilesystemIterator::UNIX_PATHS));
foreach ($it as $key => $val) {
    if ($val->getFilename() == '..' || $it->isDot() && $it->getDepth() == 0) {
        continue;
    }

    if ($val->getFilename() == '.') {
        echo str_repeat("\t", $it->getDepth() - 1) . substr($it->getSubPath(), strrpos($it->getSubPath(), '/')) . "\n";
    } else {
        echo str_repeat("\t", $it->getDepth()) . $key . "\n";
    }
}
]]></script>

<pre>
<?php
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/test', FilesystemIterator::KEY_AS_FILENAME | FilesystemIterator::UNIX_PATHS));
foreach ($it as $key => $val) {
    if ($val->getFilename() == '..' || $it->isDot() && $it->getDepth() == 0) {
        continue;
    }

    if ($val->getFilename() == '.') {
        echo str_repeat("\t", $it->getDepth() - 1) . substr($it->getSubPath(), strrpos($it->getSubPath(), '/')) . "\n";
    } else {
        echo str_repeat("\t", $it->getDepth()) . $key . "\n";
    }
}
?>
</pre>

<p>
    Помимо флагов <a href="filesystem-iterator">FilesystemIterator</a> есть ещё флаг <code>FilesystemIterator::FOLLOW_SYMLINKS</code>, который позволяет ходить по ссылкам в файловой системе, так как если бы это были обычные папки.
</p>

<h2>Ссылки:</h2>
<ul>
	<li><a href="http://php.net/manual/ru/class.recursivedirectoryiterator.php">Официальная документация</a></li>
</ul>