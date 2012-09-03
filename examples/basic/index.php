<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// you need Phap
require_once 'lib/Phap/phap.php';

// and you need all of your models, controllers and views
require_once 'controllers/FourZeroFourController.class.php';
require_once 'controllers/SiteController.class.php';
require_once 'models/FourZeroFourModel.class.php';
require_once 'models/SiteModel.class.php';
require_once 'views/FourZeroFourView.class.php';
require_once 'views/SiteView.class.php';

// you must define a request set which is just a multidimensional
// where the key of the outer array is either [404] or a regex pattern
// that matches the decired url. The value is an inner array where
// the first value is the first part of the name of you models,
// controllers and views - e.g.: you have a model called SiteModel,
// a controller called SiteController and a view called SiteView,
// then the first value should be 'Site'.
// the second value must be the name of the method to be called in
// the 'SiteController'
$request = new Phap\Request(array(
    '[404]' => array('FourZeroFour', 'index'),
    '#^$#' => array('Site', 'index'),
    '#^/another/page/that/takes/an/(?<id>[0-9]+)/cool/right(/)?$#' => array('Site', 'APTAIDCR')));

$phap = new Phap();
$phap->setRequest($request);
$phap->launch();
