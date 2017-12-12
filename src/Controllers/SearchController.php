<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 11/12/2017
 * Time: 14:14
 */

namespace Distilled\Controllers;

use Distilled\Service\Validation\RegExpValidator;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Distilled\Service\Api\ApiService;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

/**
 * All search actions.
 *
 * Class SearchController
 * @package Distilled\Controllers
 */
class SearchController
{

    /**
     * Render the search form.
     *
     * @param Application $app
     * @return mixed
     */
    public function indexAction(Application $app)
    {
        return $app['twig']->render('partials/search_form.html.twig');
    }

    /**
     * Perform the search.
     *
     * @param Request $request
     * @param Application $app
     * @return Response
     */
    public function searchAction(Request $request, Application $app)
    {
        $input = $request->get('search');
        $radio = $request->get('choice') ? $request->get('choice') : 'beer';
        $validator = new RegExpValidator($input);
        $validator->setRules('/^[a-zA-Z0-9\-\ ]+$/');
        if (!$valid = $validator->validate()) {
            return new Response(
                'Thats an invalid input',
                Response::HTTP_BAD_REQUEST,
                array('Content-Type' => 'text/html')
            );
        };
        $client = new ApiService(new Client($app['api.baseURI']));
        $client->setOptions('GET', 'search', ['query' => ['key' => getenv('BREWERYDB_API_KEY'), 'withBreweries' => 'Y', 'q' => $input, 'type' => $radio]]);
        $response = $client->sendRequest();
        $searchResults = $client->validateSearchHasResults($response);

        return $app['twig']->render('partials/search_results.html.twig', array(
            'brewery_beers' => $searchResults
        ));
    }
}
