<?php
require("vendor/autoload.php");
require("includes/bootstrapper.php");
use Includes\Router;
use Includes\Request;
use Includes\Controllers\SystemController;

//if (logged_in()) {
//    Router::load('routes.php')->redirect(Request::uri(),Request::method());
//}
if (SystemController::loggedIn()) {
    Router::load('routes.php')->redirect(Request::uri(),Request::method());
}
else {
    include "loginform.php";

}

