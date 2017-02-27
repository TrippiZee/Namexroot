<?php

namespace Includes\Controllers;

use Carbon\Carbon;
use Includes\App;
use Includes\Models\Customers;
use Includes\Models\Manifest;
use Includes\Models\Waybills;
use Includes\Models\Pod;
use Includes\Models\Services;


class DashboardController{

    public function dashboard(){

        $pdo = App::get('pdo');

        $manifest = new Manifest();
        $currentManifests = $manifest->getCurrentManifests();
        $day = Carbon::now();
        $services = new Services();
        $getServices = $services->getServices($pdo);

        return view('dashboard',['date'=>$currentManifests,'currentDay'=>$day->toDateString(),'services'=>$getServices]);
//        return view('dashboard');
    }

    public function addEditWaybill(){
        $model = new Waybills();

        if (isset($_POST['editWaybill'])) {
//            $model->editWaybillDashboard();
            $model->editWaybill();
        }

    }

}

