<?php

require_once 'protected/vendors/autoload.php';

$app = new \Silex\Application();

require 'protected/config.php';
require 'protected/app.php';
require 'protected/routing.php';

$app->run();