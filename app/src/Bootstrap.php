<?php
/**
 * This file is part of the Lote project by Sidra Blue.
 * http://sidrablue.com/lote/
 */

namespace BlueSky;

use BlueSky\Framework\Application\App\Bootstrap as BaseBootstrap;
use BlueSky\Framework\Auth\Acl\Context;
use BlueSky\Framework\Routing\Route;
use BlueSky\Framework\Event\Data;

class Bootstrap extends BaseBootstrap
{

    /**
     * @param \BlueSky\Framework\View\Base $view
     * @param string $reference
     */
    public function setupView($view, $reference)
    {
        if ($reference == 'twig') {
            /**
             * @var \BlueSky\Framework\View\Transform\Html\Base $view
             * */
        }
    }

    /**
     * Setup the routes for this app.
     * @param \BlueSky\Framework\Routing\RouteCollection $router
     * @internal Route $route
     */
    public function setupRoutes($router)
    {
        $this->setupWebsiteContactRoutes($router);
        $this->setupWebsiteQuoteRoutes($router);
    }

    /**
     * Setup the directory routes for this system.
     * @param \Symfony\Component\Routing\RouteCollection $router
     * @internal Route $route
     */
    public function setupWebsiteContactRoutes($router)
    {
        $defaults = [
            '_handler' => ['app' => 'bluesky']
        ];
        $requirements = ['format' => '(\.[a-z]+)?', 'id' => '(\d+)'];

        /** @see \Bluesky\Controller\Contact\Form\Edit */
        $defaults['controller'] = 'BlueSky\Controller\Contact\Form\Edit';

        /** @see \Bluesky\Controller\Contact\Form\Edit::validate() */
        $defaults['_method'] = 'validate';
        $route = new Route('contact/validate{format}', $defaults, $requirements);
        $router->add('website.bluesky.contact.validate', $route);

    }

    /**
     * Setup the directory routes for this system.
     * @param \Symfony\Component\Routing\RouteCollection $router
     * @internal Route $route
     */
    public function setupWebsiteQuoteRoutes($router)
    {
        $defaults = [
            '_handler' => ['app' => 'bluesky']
        ];
        $requirements = ['format' => '(\.[a-z]+)?', 'id' => '(\d+)'];

        /** @see \Bluesky\Controller\Quote\Form\Edit */
        $defaults['controller'] = 'BlueSky\Controller\Quote\Form\Edit';

        /** @see \Bluesky\Controller\Quote\Form\Edit::validate() */
        $defaults['_method'] = 'validate';
        $route = new Route('quote/validate{format}', $defaults, $requirements);
        $router->add('website.bluesky.quote.validate', $route);

        /** @see \Bluesky\Controller\Quote\Form\Edit::fileSave() */
        $defaults['_method'] = 'fileSave';
        $route = new Route('quote/file-save{format}', $defaults, $requirements);
        $router->add('website.bluesky.quote.file-save', $route);
    }

}
