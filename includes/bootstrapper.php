<?php

use Includes\Models\Connection;
use Includes\App;
//require ("includes/core.php");
require ("includes/db_connection.php");

App::bind('config',require ("config.php"));

//App::bind('connection',require ("includes/db_connection.php"));

App::bind('pdo',Connection::connect(App::get('config')['databaseLocal']));

