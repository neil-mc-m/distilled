<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 10/12/2017
 * Time: 20:59
 */

namespace Distilled\Controllers;

use Distilled\Service\ApiService;
use GuzzleHttp\Client;
use Silex\Application;

class BreweryController
{
    public function indexAction(Application $app, $id)
    {
        $client = new ApiService(new Client($app['api.baseURI']));
        $client->setOptions('GET', 'brewery/'.$id.'/beers', ['query' => ['key' => getenv('BREWERYDB_API_KEY'), 'hasLabels' => 'Y']]);
        $response = $client->sendRequest();
        $breweryBeers = $client->validateAndExtractResponse($response);
        
        return $app['twig']->render('partials/search_results.html.twig', array(
            'brewery_beers' => $breweryBeers
        ));
    }
}
