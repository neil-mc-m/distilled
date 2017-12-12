<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/12/2017
 * Time: 22:50
 */

namespace Distilled\Service\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

/**
 * Class ApiService
 * @package Distilled\Service
 */
class ApiService
{

    /**
     * An array of query options to get appended to the query string.
     * @var array
     */
    protected $query = [];

    /**
     * Http method defaults to get.
     * @var string
     */
    protected $method = 'GET';

    /**
     * The endpoint to request
     * @var
     */
    protected $path;

    /**
     * The Http client, in this case, an instance of Guzzle.
     * @var Client
     */
    protected $client;


    /**
     * Construct the class with an instance of the client.
     *
     * ApiService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Set up the options.
     *
     * @param $method
     * @param $path
     * @param $query
     */
    public function setOptions($method, $path, $query)
    {
        $this->method = $method;
        $this->path = $path;
        $this->query = $query;
    }

    /**
     * Send the request.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendRequest()
    {
        $response = $this->client->request($this->method, $this->path, $this->query);
        if (!$response->getStatusCode() === 200) {
            throw new \Exception('Either the resource cant be found or theres a problem with the request.');
        }
        return $response;
    }

    /**
     * Validate the response has a given key.
     *
     * @param $response
     * @param $key
     * @return mixed
     */
    public function validateResponseHasKey($response, $key)
    {
        $responseArray = $this->getResponseBody($response);
        if (isset($responseArray['data'][$key])) {
            return $responseArray;
        } else {
            $newBeer = $this->sendRequest();
            $new = $this->validateResponseHasKey($newBeer, $key);
            return $new;
        }
    }

    /**
     * Check to see there are some results.
     *
     * @param $response
     * @return Response|mixed
     */
    public function validateSearchHasResults($response)
    {
        $responseArray = $this->getResponseBody($response);
        if (isset($responseArray['data'])) {
            return $responseArray;
        } else {
            return new Response(500);
        }
    }

    /**
     * Get the response body and decode to assoc array.
     *
     * @param $response
     * @return mixed
     */
    public function getResponseBody($response)
    {
        $beerArray = json_decode($response->getBody()->getContents(), true);

        return $beerArray;
    }
}
