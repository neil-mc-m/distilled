<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/12/2017
 * Time: 12:16
 */
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/../vendor/autoload.php';
$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();

$app = new Silex\Application();
$app['debug'] = true;
$app['api.baseURI'] = array('base_uri' => 'http://api.brewerydb.com/v2/');
$app->register(new HttpFragmentServiceProvider());
$app->register(new TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

$app->error(function (\Exception $e, $code) use ($app) {
    $page = 'error.html.twig';
    return new Response($app['twig']->render($page, array('message' => $e->getMessage())));
});
$app->get('/', 'Distilled\\Controllers\\HomePageController::indexAction');
$app->get('/home', 'Distilled\\Controllers\\HomePageController::indexAction');
$app->get('/brewery/{id}', 'Distilled\\Controllers\\BreweryController::indexAction');
$app->get('/search', 'Distilled\\Controllers\\SearchController::searchAction');
return $app;
