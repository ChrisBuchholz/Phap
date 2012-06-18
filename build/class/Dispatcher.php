<?php

namespace Phap;

class Dispatcher {

    /* ***** private variables ***** */

    private $factory;
    private $routes;
    private $url;
    private $verb;
    private $post;
    private $cookie;
    private $session;
    private $controllerName;
    private $actionName;
    private $parameters;

    /* ***** private methods ***** */

    private function parseRequest() {
        $four_zero_four = array();
        $is_match = false;

        foreach($this->routes as $key => $value) {
            if($key == '[404]') {
                $four_zero_four = $value;
            }
            else {
                if(preg_match($key, $this->url, $matches)) {
                    $this->controllerName = $value[0];
                    $this->actionName = $value[1];
                    $this->parameters = array_slice($matches, 1);
                    $is_match = true;
                }
            }
        }

        if(!$is_match) {
            $this->controllerName = $four_zero_four[0];
            $this->actionName = $four_zero_four[1];
        }

    }

    /* ***** public methods ***** */

    public function __construct(IControllerFactory $factory) {
        $this->factory = $factory;
    }

    public function dispatch($routes, $url, $verb, $post, $cookie, $session) {
        $this->routes = $routes;
        $this->url = $url;
        $this->verb = $verb;
        $this->post = $post;
        $this->cookie = $cookie;
        $this->session = $session;

        $this->parseRequest();

        $controller = $this->factory->getController($this->controllerName);
        $controller->setParameters($this->parameters);
        $controller->setVerb($this->verb);
        $controller->invoke($this->actionName);
    }

}
