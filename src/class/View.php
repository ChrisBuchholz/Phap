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

abstract class View {

    /* ***** private methods ***** */

    // if you come to this page by being redirected by 
    // Redirect::to()->with_input(...), make that input data available
    // in the $data array
    private function bootstrapInput(&$data) {
        if (isset($_SESSION['phap_input'])) {
            foreach ($_SESSION['phap_input'] as $key => $value) {
                $data["input-$key"] = $value;
            }
            unset($_SESSION['phap_input']);
        }
    }

    // if you come to this page by being redirected by 
    // Redirect::to()->with_errors(...), make that error data available
    // in the $data array
    private function bootstrapErrors(&$data) {
        if (isset($_SESSION['phap_errors'])) {
            foreach ($_SESSION['phap_errors'] as $key => $value) {
                $data["errors-$value"] = true;
            }
            unset($_SESSION['phap_errors']);
        }
    }

    /**
     * getTemplateContents
     *
     * gets the content of both template and partials and updates them,
     * by reference, to contain it
     **/
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

    /**
     * render
     *
     * renders the requested mustache template with partials and everything
     *
     * will use utf-8 - this should probably not be hardcoded
     **/
    public function render($data, $template, $partials = array()) {
        $this->bootstrapInput($data);
        $this->bootstrapErrors($data);
        $data['rootPath'] = ROOTPATH;
        $this->getTemplateContents($template, $partials);
        $mustache = new \Mustache_Engine(array(
            'partials' => $partials,
            'escape' => function($value) {
                return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
            },
            'charset' => 'UTF-8'
        ));
        echo $mustache->render($template, $data);
    }

}
