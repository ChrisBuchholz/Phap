<?php

namespace Phap;

abstract class View {

    /* ***** private methods ***** */

    private function getTemplateContents(&$template, &$partials) {
        $template = file_get_contents($template);
        foreach(array_keys($partials) as $pkey)
            $partials[$pkey] = file_get_contents($partials[$pkey]);
    }

    /* ***** public methods ***** */

    public function setData($data) {
        $this->data = $data;
    }

    public function setTemplateName($name) {
        $this->templateName = $name;
    }

    public function render($data, $template, $partials = array()) {
        $this->getTemplateContents($template, $partials);
        $mustache = new \Mustache_Engine;
        echo $mustache->render(
            $template,
            $data,
            $partials
        );
    }

}
