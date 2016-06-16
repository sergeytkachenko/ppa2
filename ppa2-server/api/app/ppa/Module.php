<?php

namespace Multiple\PPA;

use Phalcon\DiInterface;
use Phalcon\Loader,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Mvc\View,
    Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface {

    /**
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'Multiple\PPA\Controllers' => '../app/ppa/controllers/',
            )
        );

        $loader->register();
    }

    /**
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        $di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("Multiple\PPA\Controllers");
            return $dispatcher;
        });

        $view = $di->get("view");
        $view->setViewsDir('../app/ppa/views/');
        $di->set('view', $view);
    }

}