<?php

use Silex\Provider\TwigServiceProvider;
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$app->register(new TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));
$app->get('/home','Distilled\\Controllers\\HomePageController::indexAction');

$app->run();
