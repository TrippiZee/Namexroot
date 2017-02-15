<?php
//require("../bootstrapper.php");
//$router = new Router;
//require '../../routes.php';
//$uri = trim($_SERVER['REQUEST_URI'],'/');
//var_dump($_SERVER['REQUEST_URI']);
//require $router->redirect($uri);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Namibia Express Transport Doc Management System</title>
    <link href="public/stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="public/stylesheets/dataTables.bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="public/scripts/jquery-ui-1.12.1/jquery-ui.min.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="public/scripts/jquery-ui-1.12.1/jquery-ui.structure.min.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="public/scripts/jquery-ui-1.12.1/jquery-ui.theme.min.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="public/stylesheets/jquery-ui-timepicker-addon.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="public/stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="container-fluid">
    <div id="head" class="row">
        <div class="col-sm-12">
        <div id="logo"></div>
        <div id="user">Welcome: <?php echo getuserfield('name').' '.getuserfield('surname') ?> <br/>
            <a href="logout">Logout</a>
        </div>
        </div>
    </div>
<?php
include "sidemenu.php";
?>
