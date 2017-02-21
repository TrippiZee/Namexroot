<?php

namespace Includes\Controllers;

use Includes\App;
use Includes\Models\Customers;
use Includes\Models\Manifest;
use Includes\Models\Waybills;
use Includes\Models\Pod;

class DashboardController{

    public function dashboard(){

        $manifest = new Manifest();
        $test = $manifest->getCurrentManifests();
//        $test = "test var";
        return view('dashboard',['date'=>$test]);
//        return view('dashboard');
    }

}

