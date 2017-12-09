<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/12/2017
 * Time: 10:42
 */

namespace Distilled\Controllers;

use Silex\Application;
use GuzzleHttp\Client;

/**
 * Class HomePageController
 * @package Distilled\Controllers
 */
class HomePageController
{

    /**
     * Serve the homepage.
     *
     * @param Application $app
     * @return twig template response
     */
    public function indexAction(Application $app)
    {
        $client = new Client([
            'base_uri' => 'http://api.brewerydb.com/v2/',
        ]);
        $response = $client->request(
            'GET',
            'beer/random',
            ['query' => ['key' => getenv('BREWERYDB_API_KEY'), 'hasLabels' => 'Y']]
        );

        $randomBeer = json_encode(json_decode($response->getBody()->getContents()), JSON_PRETTY_PRINT);
        file_put_contents('json/release.json', $randomBeer);
        $beer = json_decode($randomBeer, true);
        return $app['twig']->render('home.html.twig', array(
            'random_beer' => $beer
        ));
    }
}
