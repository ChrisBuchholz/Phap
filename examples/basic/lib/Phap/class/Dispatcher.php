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

    private $_factory;
    private $_routes;
    private $_url;
    private $_verb;
    private $_controllerName;
    private $_actionName;
    private $_parameters;

    /* ***** private methods ***** */

    /**
     * parseRequest
     **/
    private function parseRequest() {
        $four_zero_four = array();
        $is_match = false;

        // runs all the routes through and searches for a fit the matches
        // the request
        foreach($this->_routes as $key => $value) {
            if($key == PHAP_404_ROUTE) {
                $four_zero_four = $value;
            }
            else {
                // does the requests url match the regex request pattern($key)?
                if(preg_match($key, $this->_url, $matches)) {
                    $this->_controllerName = $value[0];
                    $this->_actionName = $value[1];
                    $this->_parameters = array_slice($matches, 1);
                    $is_match = true;
                }
            }
        }

        // if there is no route matching the request, it reverts to the 
        // 404 route, and one exists 
        if(!$is_match) {
            header('HTTP/1.0 404 Not Found');
            $this->_controllerName = $four_zero_four[0];
            $this->_actionName = $four_zero_four[1];
        }

    }

    /* ***** public methods ***** */

    public function __construct(IControllerFactory $factory) {
        $this->_factory = $factory;
    }

    /**
     * dispatch
     **/
    public function dispatch($routes, $url, $verb) {
        $this->_routes = $routes;
        $this->_url = $url;
        $this->_verb = $verb;

        $this->parseRequest();

        $controller = $this->_factory->getController($this->_controllerName);
        $controller->setParameters($this->_parameters);
        $controller->setVerb($this->_verb);
        $controller->invoke($this->_actionName);
    }

}
