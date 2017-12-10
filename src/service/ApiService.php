<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/12/2017
 * Time: 22:50
 */

namespace Distilled\Service;

use GuzzleHttp\ClientInterface;

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
    private $query = [];

    /**
     * Http method defaults to get.
     * @var string
     */
    private $method = 'GET';

    /**
     * The endpoint to request
     * @var
     */
    private $path;

    /**
     * The Http client, in this case, an instance of Guzzle.
     * @var ClientInterface
     */
    private $client;


    /**
     * Construct the class with an instance of the client.
     *
     * ApiService constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
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
        return $response;
    }

    /**
     * Validate that the response has a description key.
     * If not, resend the request.
     *
     * @param $response
     * @return mixed
     */
    public function validateResponse($response)
    {
        $responseArray = json_decode($response->getBody()->getContents(), true);
        if (isset($responseArray['data']['description'])) {
            return $responseArray;
        } else {
            $newResponse = $this->sendRequest();
            $new = $this->validateResponse($newResponse);
            return $new;
        }
    }
}
