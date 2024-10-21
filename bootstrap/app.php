<?php

/**
 * Check Maintainance Mode
*/

use Atova\Eshoper\Foundation\Database;
use Atova\Eshoper\Foundation\Model;
use Atova\Eshoper\Foundation\Session;

/**
 * Load Application Constants
*/

require_once __DIR__."/../app/Support/constants.php";
/**
 * Load Vendor
*/

require PROJECT_ROOT."/vendor/autoload.php";

/**
 * Load Core Config Class
 * Don't need to load explicitly
*/

/**
 * Initialize Session
*/

$session = new Session();

/**
 * Load Database
*/

$db = new Database();


/**
 * Load Core BaseController
*/


$init = new Atova\Eshoper\Foundation\Controller();



