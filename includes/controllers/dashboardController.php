<?php

namespace Includes\Controllers;

use Carbon\Carbon;
use Includes\App;
use Includes\Models\Customers;
use Includes\Models\Manifest;
use Includes\Models\Waybills;
use Includes\Models\Pod;

class DashboardController{

    public function dashboard(){

        $manifest = new Manifest();
        $test = $manifest->getCurrentManifests();
        $day = Carbon::now();
        return view('dashboard',['date'=>$test,'currentDay'=>$day->toDateString()]);
//        return view('dashboard');
    }

}

