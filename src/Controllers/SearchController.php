<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 11/12/2017
 * Time: 14:14
 */

namespace Distilled\Controllers;

use Distilled\Service\Validation\FormValidator;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Distilled\Service\ApiService;
use GuzzleHttp\Client;

class SearchController
{
    public function indexAction(Application $app)
    {
        return $app['twig']->render('partials/search_form.html.twig');
    }
    public function searchAction(Request $request, Application $app)
    {
        $query = $request->get('search');
        $radio = $request->get('choice');
        $validator = new FormValidator($query);
        $validator->setRules('/^[a-zA-Z0-9\-\ ]+$/');
        if (!$valid = $validator->validate()) {
            return 'Not a valid form. Try again';
        };
        $client = new ApiService(new Client($app['api.baseURI']));
        $client->setOptions('GET', 'search', ['query' => ['key' => getenv('BREWERYDB_API_KEY'), 'withBreweries' => 'Y', 'q' => $query, 'type' => $radio]]);
        $response = $client->sendRequest();
        $searchResults = $client->validateAndExtractResponse($response);
        file_put_contents('json/release.json', json_encode($searchResults, JSON_PRETTY_PRINT));
        return $app['twig']->render('partials/search_results.html.twig', array(
            'brewery_beers' => $searchResults
        ));
    }
}
