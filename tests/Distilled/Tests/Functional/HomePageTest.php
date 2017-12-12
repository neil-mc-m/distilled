<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/12/2017
 * Time: 11:48
 */

namespace Distilled\Tests\Functional;

use Silex\WebTestCase;

/**
 * Test the functionality of the homepage controller.
 *
 * Class HomePageTest
 * @package Distilled\Tests\Functional
 */
class HomePageTest extends WebTestCase
{

    /**
     * This is a required method and must return an instance of the application.
     * @return mixed
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../../../../src/app.php';

        return $this->app = $app;
    }

    /**
     * Test if the homepage is served up correctly by requesting /home route and checking the status code of the response.
     * Also checks the text content of the body, in this case the heading.
     */
    public function testHomePageControllerWorksWithCorrectRoute()
    {
        $client = $this->createClient();
        $client->followRedirects(true);
        $crawler = $client->request('GET', '/home');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Distilled SCH Beer Application', $crawler->filter('body')->text());
    }

    /**
     * Test if an incorrect route throws an error.
     */
    public function testHomePageControllerDoesntWorkWithIncorrectRoute()
    {
        $client = $this->createClient();
        $client->request('GET', '/away');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
