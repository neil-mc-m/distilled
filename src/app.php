<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/12/2017
 * Time: 12:16
 */
use Silex\Provider\TwigServiceProvider;

require_once __DIR__.'/../vendor/autoload.php';
$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();

$app = new Silex\Application();
$app['debug'] = true;
$app['api.baseURI'] = array('base_uri' => 'http://api.brewerydb.com/v2/');
$app->register(new TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));
$app->get('/home', 'Distilled\\Controllers\\HomePageController::indexAction');
return $app;
