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

class Phap {

    private $_route = null;
    private $_container;

    public function __construct() {
        // create container
        $this->_container = new Phap\Container();
    }

    /**
     * SetRoute
     **/
    public function setRoute(&$route) {
        $this->_route
            = ($route instanceof Phap\Route)
            ? $route
            : null;
        if($this->_route == null) return false;
        return true;
    } 

    /**
     * launch
     **/
    public function launch() {
        $this->_container->getDispatcher()->dispatch(
            $this->_route->getRoutes(),
            $this->_route->getUrl(),
            $this->_route->getVerb());
    }

}
