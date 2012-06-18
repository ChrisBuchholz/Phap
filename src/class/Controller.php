<?php

namespace Phap;

abstract class Controller {

    /* ***** private properties ***** */

    protected $model;
    protected $view;
    protected $parameters = array();
    protected $verb;

    /* ***** public methods ***** */

    public function setParameters($parameters) {
        $this->parameters = $parameters;
    }

    public function setVerb($verb) {
        $this->verb = $verb;
    }

    public function invoke($action) {
        if(!is_array($this->parameters)) {
            $this->parameters = array();
        }
        return call_user_func_array(array($this, $action), $this->parameters);
    }

}
