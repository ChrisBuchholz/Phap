<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once 'lib/Phap/phap.php';

require_once 'controllers/FourZeroFourController.class.php';
require_once 'controllers/SiteController.class.php';
require_once 'models/FourZeroFourModel.class.php';
require_once 'models/SiteModel.class.php';
require_once 'views/FourZeroFourView.class.php';
require_once 'views/SiteView.class.php';

$route = array(
    '[404]' => array('FourZeroFour', 'index'),
    '#^$#' => array('Site', 'index'),
    '#^/another/page/that/takes/an/(?<id>[0-9]+)/cool/right(/)?$#' => array('Site', 'APTAIDCR'));

$request = new Phap\Request($route);

$phap = new Phap();
$phap->setRequest($request);
$phap->launch();
