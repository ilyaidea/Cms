<?php
/**
 * Summary File Module
 *
 * Description File Module
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/9/2018
 * Time: 5:09 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\Backend;

use Phalcon\Events\Manager;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerAutoloaders(\Phalcon\DiInterface $di = null)
    {
        // TODO: Implement registerAutoloaders() method.
        $loader = new Loader();

        $loader->registerNamespaces([
            'Modules\Backend\Controllers' => MODULES_PATH. 'backend/controllers/',
            'Modules\Backend\Models'      => MODULES_PATH. 'backend/models/'
        ])->register();
    }

    /**
     * Registers services related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function registerServices(\Phalcon\DiInterface $di)
    {
        // TODO: Implement registerServices() method.\

        // Registering a dispatcher
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();

            $eventManager = new Manager();

            $dispatcher->setEventsManager($eventManager);
            $dispatcher->setDefaultNamespace('Modules\Backend\Controllers\\');

            return $dispatcher;
        });

        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir(MODULES_PATH. 'backend/views/');
            return $view;
        });
    }
}