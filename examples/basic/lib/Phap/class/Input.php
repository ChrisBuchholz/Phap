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

class Input {

    /* ******* private properties ******* */

    private static $_post = false;
    private static $_files = false;

    /* ******* private static methods ******* */

    private static function _bootstrapPost() {
        if (!self::$_post) 
            self::$_post = $_POST;
        return self::$_post;
    }

    private static function _bootstrapFile() {
        if (!self::$_files) 
            self::$_files = $_FILES;
        return self::$_files;
    }

    /* ******* public static methods ******* */

    public static function post($key = false, $defaultValue = false) {
        $post = self::_bootstrapPost();
        if ($key)
            return array_key_exists($key, $post) ? $post[$key] : $defaultValue;
        else
            return $post;
    }

    public static function has($key) {
        $post = self::_bootstrapPost();
        return array_key_exists($key, $post);
    }

    public static function file($key = false, $meta = false) {
        $file = self::_bootstrapFile();
        if ($key)
            $rtrn = array_key_exists($key, $file) ? $file[$key] : false;
        else
            $rtrn = $file;
        if ($meta)
            return array_key_exists($meta, $rtrn) ? $rtrn[$meta] : false;
        return $rtrn;
    }

}
