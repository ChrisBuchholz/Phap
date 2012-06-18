<?php

namespace Phap;

class Container implements IControllerFactory {

    /* ***** public methods ***** */

    public function getDispatcher() {
        return new Dispatcher($this);
    }

    public function getController($name) {
        $modelName = "{$name}Model";
        $controllerName = "{$name}Controller";
        $viewName = "{$name}View";
        return new $controllerName(new $modelName, new $viewName);
    }
}
