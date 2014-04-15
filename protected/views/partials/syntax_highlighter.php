<link href="<?php echo $view['assets']->getUrl('styles/shCore.css', 'syntax_highlighter') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo $view['assets']->getUrl('styles/shThemeDefault.css', 'syntax_highlighter') ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('scripts/XRegExp.js', 'syntax_highlighter') ?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('scripts/shCore.js', 'syntax_highlighter') ?>"></script>
<?php
if (!empty($brushes)) {
	$brushes = (array)$brushes;
	foreach ($brushes as $brush) {
		?>
		<script type="text/javascript" src="<?php echo $view['assets']->getUrl('scripts/shBrush' . $brush . '.js', 'syntax_highlighter') ?>"></script>
	<?php
	}
}
?>
<script type="text/javascript">
	SyntaxHighlighter.defaults['toolbar'] = false;
	SyntaxHighlighter.all();
</script>