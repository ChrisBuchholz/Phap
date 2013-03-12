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

// this file acts as the "front-end" that takes care of getting all the needed
// files, and sets everything up needed to use Phap, so to use Phap, one should
// only need to include this file

session_start();

define('PHAP_404_ROUTE', 'phap_404_route');

function endWithSlash($str) { return substr($str, -1) == '/' ? $str : $str . '/'; }
!defined('ROOTPATH') && define('ROOTPATH', endWithSlash(dirname($_SERVER['SCRIPT_NAME'])));

require_once 'class/IControllerFactory.php';
require_once 'class/Container.php';
require_once 'class/Controller.php';
require_once 'class/Dispatcher.php';
require_once 'class/Model.php';
require_once 'class/Route.php';
require_once 'class/View.php';
require_once 'class/Input.php';
require_once 'class/Validator.php';
require_once 'class/Redirect.php';
require_once 'class/Phap.php';

require_once 'lib/markdown/markdown.php';

require 'lib/Mustache/Autoloader.php';
Mustache_Autoloader::register();
