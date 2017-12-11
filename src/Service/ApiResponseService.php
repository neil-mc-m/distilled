<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 10/12/2017
 * Time: 21:40
 */

namespace Distilled\Service;

use GuzzleHttp\Psr7\Response;

/**
 * Class ApiResponseService
 * @package Distilled\Service
 */
class ApiResponseService extends ApiRequestService
{

    /**
     * @var
     */
    private $response;

    /**
     * ApiResponseService constructor.
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Validate that the response has a valid key.
     * If not, resend the request.
     *
     * @param $key
     * @return mixed
     */
    public function validateResponse($key)
    {
        $responseArray = json_decode($this->response->getBody()->getContents(), true);
        if (isset($responseArray['data'][$key])) {
            return $responseArray;
        } else {
//            $newResponse = $this->sendRequest();
//            $new = $this->validateResponse($key);
//            return $new;
            return false;
        }
    }
}
