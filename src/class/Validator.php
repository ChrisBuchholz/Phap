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

class Validator {

    /* ******* private properties ******* */

    private $_input;
    private $_rules;
    private $_errors;

    /* ******* private methods ******* */

    private function compile() {
        $tokens = array(
            '/^required$/' => function($str) {
                return !empty($str);
            },
            '/^email$/' => function($str) {
                return filter_var($str, FILTER_VALIDATE_EMAIL);
            },
            '/^url$/' => function($str) {
                return filter_var($str, FILTER_VALIDATE_URL);    
            },
            '/^num$/' => function($str) {
                return is_numeric($str); 
            });

        $input = $this->_input;
        $rules = $this->_rules;
        $errors = array();
        $num_checked = 0;

        foreach ($input as $key => $value) {
            if(array_key_exists($key, $rules)) {
                $exprns = explode("|", $rules[$key]); 
                foreach($exprns as $exprn) {
                    foreach($tokens as $token => $func) {
                        if (preg_match($token, $exprn)) {
                            $res = $func($value);
                            if (!$res)
                                array_push($errors, $key);
                        }
                    } 
                }
            }
            $num_checked++;
        }

        if ($num_checked === 0) {
            foreach ($rules as $key => $value)
                array_push($errors, $key);
        }

        $this->_errors = array_unique($errors);
    }

    /* ******* public methods ******* */

    public function __construct($input, $rules) {
        $this->_input = $input;
        $this->_rules = $rules;
        $this->compile();
    }

    public function fails() {
        return count($this->errors()) > 0 ? true : false; 
    }

    public function errors() {
        return $this->_errors;
    }

    /* ******* public static methods ******* */

    public static function make($input, $rules) {
        return new Validator($input, $rules);
    }

}
