<?php

function view($name,$data = []){
    extract($data);

    return require "includes/views/{$name}.view.php";
}
