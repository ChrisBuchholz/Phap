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

class Redirect {

    /* ******* private properties ******* */

    private $_where;
    private $_input = false;
    private $_errors = false;

    /* ******* public methods ******* */

    public function __construct($where) {
        $this->_where = $where;
    }

    public function __destruct() {
        $_SESSION["phap_input"] = $this->_input;
        $_SESSION["phap_errors"] = $this->_errors;
        header('location: ' . $this->_where);
        exit; 
    }

    public function with_input($input) {
        $this->_input = $input;
        return $this;
    }

    public function with_errors($errors) {
        $this->_errors = $errors;
        exit;
        return $this;
    }

    /* ******* public static methods ******* */

    public static function to($where) {
        return new Redirect($where); 
    }

}
