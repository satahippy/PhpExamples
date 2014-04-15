<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<title>PHP Examples. <?php $view['slots']->output('title') ?></title>
		<link href="<?php echo $view['assets']->getUrl('css/bootstrap.css') ?>" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $view['assets']->getUrl('css/style.css') ?>" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<?php echo $view->render('partials/header.php'); ?>
		<div class="site container">
			<?php echo $view->render('partials/breadcrubms.php', array(
				'items' => $view['slots']->get('breadcrumbs', array())
			)); ?>
			<?php $view['slots']->output('_content'); ?>
		</div>
		<?php echo $view->render('partials/footer.php'); ?>
	</body>
</html>