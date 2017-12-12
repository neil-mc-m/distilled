<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/12/2017
 * Time: 10:42
 */

namespace Distilled\Controllers;

use Distilled\Service\Api\ApiService;
use Silex\Application;
use GuzzleHttp\Client;

/**
 * Class HomePageController
 * @package Distilled\Controllers
 */
class HomePageController
{

    /**
     * Serve the homepage with a random beer.
     *
     * @param Application $app
     * @return twig template response
     */
    public function indexAction(Application $app)
    {
        $client = new ApiService(new Client($app['api.baseURI']));
        $client->setOptions('GET', 'beer/random', ['query' => ['key' => getenv('BREWERYDB_API_KEY'), 'hasLabels' => 'Y', 'withBreweries' => 'Y']]);
        $response = $client->sendRequest();
        $validatedBeer = $client->validateResponseHasKey($response, 'description');

        return $app['twig']->render('home.html.twig', array(
            'random_beer' => $validatedBeer
        ));
    }
}
