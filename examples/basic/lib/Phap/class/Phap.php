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

    private $_hasDothtaccessRewrite = true;
    private $_request = null;
    private $_container;

    public function __construct($hasDothtaccessRewrite = false) {
        // has .htaccess rewrite?
        $this->setHasDothtaccessRewrite($hasDothtaccessRewrite); 

        // create container
        $this->_container = new Phap\Container();
    }

    /**
     * setHasDothtaccessRewrite
     *
     * sets _hasDothtaccessRewrite to boolean TRUE or FALSE
     * defaults to false
     * this determines whether or not Routes should rely on pretty urls
     * from via htaccess or just use $_GET
     **/
    public function setHasDothtaccessRewrite($hasDothtaccessRewrite = false) {
        $this->_hasDothtaccessRewrite
            = is_bool($hasDothtaccessRewrite)
            ? $hasDothtaccessRewrite
            : $this->_hasDothtaccessRewrite;
        return $this->_hasDothtaccessRewrite;
    }

    /**
     * SetRequest
     **/
    public function setRequest(&$request) {
        $this->_request
            = ($request instanceof Phap\Request)
            ? $request
            : null;

        if($this->_request == null) return false;
        return true;
    } 

    /**
     * launch
     **/
    public function launch() {
        $this->_container->getDispatcher()->dispatch(
            $this->_request->getRoutes(),
            $this->_request->getUrl(),
            $this->_request->getVerb(),
            $this->_request->getPost(),
            $this->_request->getCookie(),
            $this->_request->getSession());
    }

}
