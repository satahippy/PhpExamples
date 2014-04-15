<?php

$app->get('/{path}', function ($path) use ($app) {
	if (substr($path, strlen($path) - 1) === '/') {
		$path .= 'index';
	}
	return $app['templater']->render('pages/' . $path . '.php');
})->assert('path', '.+')->value('path', 'index');