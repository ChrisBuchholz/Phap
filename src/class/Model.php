<?php

namespace Phap;

abstract class Model {

    /* ***** protected properties ***** */

    protected $data = array();

    /* ***** public methods ***** */

    public function getMarkdown($file) {
        $content = file_get_contents($file);
        return Markdown($content);
    }

}
