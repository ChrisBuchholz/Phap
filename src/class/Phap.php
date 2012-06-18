<?php

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
