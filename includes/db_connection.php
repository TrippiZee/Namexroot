<?php

////$connection = mysqli_connect("sql26.jnb1.host-h.net", "Namibmhz_app1", "Nam1b987App", "Namibmhz_app1");
//$connection = mysqli_connect("localhost", "namexapp", "root", "");
//if(mysqli_connect_errno()) {
//    die("Database connection failed: " .
//        mysqli_connect_error() .
//        " (" . mysqli_connect_errno() . ")"
//    );
//}
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "namexapp");

// 1. Create a database connection
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Test if connection succeeded
if(mysqli_connect_errno()) {
    die("Database connection failed: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")"
    );
}

?>