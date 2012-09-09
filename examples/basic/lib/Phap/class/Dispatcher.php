<?php

/**
 * Copyright (C) 2012 Christoffer Buchholz <http://chrisbuchholz.me/>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 * Source Code: https://github.com/ChrisBuchholz/Phap
 **/

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
                header('HTTP/1.0 404 Not Found');
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
