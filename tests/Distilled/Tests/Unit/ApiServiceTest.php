<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/12/2017
 * Time: 22:51
 */

namespace Distilled\Tests\Unit;

use Distilled\Service\Api\ApiService;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * An attempt to test the apiservice class. Quite difficult and a bit beyond me.
 *
 * Class ApiServiceTest
 * @package Distilled\Tests\Unit
 */
class ApiServiceTest extends TestCase
{
    public function testSendRequest()
    {
        $stub = $this->getMockBuilder(ApiService::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $response = new Response(200);
        $stub->expects($this->once())
            ->method('sendRequest')
            ->will($this->returnValue($response));
        $this->assertInstanceOf(Response::class, $stub->sendRequest());
    }

    public function testGetResponseBodyReturnsArray()
    {
        $stub = $this->getMockBuilder(ApiService::class)
            ->disableOriginalConstructor()
            ->setMethods(array('setOptions', 'sendRequest'))
            ->getMock();

        $response = new Response(200);
        $this->assertInternalType('array', $stub->getResponseBody($response));
    }
}
