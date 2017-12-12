<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 10/12/2017
 * Time: 20:59
 */

namespace Distilled\Controllers;

use Distilled\Service\Api\ApiService;
use GuzzleHttp\Client;
use Silex\Application;

/**
 * Class BreweryController
 * @package Distilled\Controllers
 */
class BreweryController
{

    /**
     * Performs a lookup to the Api and renders a template with the results.
     *
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function indexAction(Application $app, $id)
    {
        $client = new ApiService(new Client($app['api.baseURI']));
        $client->setOptions('GET', 'brewery/'.$id.'/beers', ['query' => ['key' => getenv('BREWERYDB_API_KEY')]]);
        $response = $client->sendRequest();
        $breweryBeers = $client->getResponseBody($response);

        return $app['twig']->render('partials/search_results.html.twig', array(
            'brewery_beers' => $breweryBeers
        ));
    }
}
