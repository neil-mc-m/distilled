<?php
/**
 * Created by PhpStorm.
 * User: neil
 * Date: 09/12/2017
 * Time: 10:42
 */

namespace Distilled\Controllers;

use Silex\Application;

/**
 * Class HomePageController
 * @package Distilled\Controllers
 */
class HomePageController
{

    /**
     * Serve the homepage.
     *
     * @param Application $app
     * @return twig template response
     */
    public function indexAction(Application $app)
    {
        return $app['twig']->render('home.html.twig', array());
    }
}
