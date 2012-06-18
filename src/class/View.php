<?php

namespace Phap;

abstract class View {

    /* ***** public methods ***** */

    public function setData($data) {
        $this->data = $data;
    }

    public function setTemplateName($name) {
        $this->templateName = $name;
    }

    public function render($data, $template, $partials = array()) {
        $mustache = new \Mustache();
        echo $mustache->render(
            file_get_contents($template),
            $data,
            $partials
        );
    }

}
