<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/12/2017
 * Time: 22:51
 */

namespace Distilled\Tests\Unit;

use Distilled\Service\Api\ApiService;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Constraint\IsInstanceOf;
use PHPUnit\Framework\TestCase;

class ApiServiceTest extends TestCase
{
    public function testSetOptions()
    {
        $stub = $this->getMockBuilder(ApiService::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
        $stub->method('getOptions')
            ->willReturn('foo');
        $this->assertEquals('foo', $stub->getOptions());
    }
}
