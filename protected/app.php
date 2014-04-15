<?php

use \Symfony\Component\Templating\PhpEngine;
use \Symfony\Component\Templating\TemplateNameParser;
use \Symfony\Component\Templating\Loader\FilesystemLoader;
use \Symfony\Component\Templating\Helper\SlotsHelper;
use \Symfony\Component\Templating\Helper\AssetsHelper;
use \Symfony\Component\Templating\Asset\PathPackage;

$app['templater'] = $app->share(function ($app) {
	$templater = new PhpEngine(new TemplateNameParser(), new FilesystemLoader('protected/views/%name%'));
	$templater->set(new SlotsHelper());

	$templater->set(new AssetsHelper('/assets/'));
	$templater->get('assets')->addPackage('syntax_highlighter', new PathPackage('/assets/other/SyntaxHighlighter/'));

	return $templater;
});