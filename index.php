<?php
require("vendor/autoload.php");
require("includes/bootstrapper.php");
use Includes\Router;
use Includes\Request;

if (logged_in()) {
    Router::load('routes.php')->redirect(Request::uri(),Request::method());
} else {
    include "/loginform.php";

}

