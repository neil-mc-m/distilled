<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/12/2017
 * Time: 22:51
 */

namespace Distilled\Tests\Unit;

use Distilled\Service\ApiService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ApiServiceTest extends TestCase
{
    public function testCreateApiClientObject()
    {
        $response = new Response(200);
        $client = $this->getMockBuilder(Client::class)
            ->getMock();

        $apiService = new ApiService($client);

        $apiResponse = $apiService->sendRequest();
        $this->assertSame($response, $apiResponse);
    }
}
