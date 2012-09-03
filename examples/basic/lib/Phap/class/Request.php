<?php

namespace Phap;

class Request {

    /* ***** private properties ***** */

    private $routes;
    private $url;
    private $verb;
    private $post;
    private $cookie;
    private $session;

    /* ***** public methods ***** */

    public function __construct($routes) {
        $this->routes = $routes;
        $this->url = @$_SERVER["PATH_INFO"];
        $this->verb = $_SERVER["REQUEST_METHOD"];
        $this->post = $_POST;
        $this->cookie = $_COOKIE;
        $this->session = $_SESSION;
    }

    public function getRoutes() {
        return $this->routes;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getVerb() {
        return $this->verb;
    }

    public function getPost() {
        return $this->post;
    }

    public function getCookie() {
        return $this->cookie;
    }

    public function getSession() {
        return $this->session;
    }

}
