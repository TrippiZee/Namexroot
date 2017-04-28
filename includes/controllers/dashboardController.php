<?php

namespace Includes\Controllers;

use Carbon\Carbon;
use Includes\App;
use Includes\Models\Customers;
use Includes\Models\Manifest;
use Includes\Models\Waybills;
use Includes\Models\Pod;
use Includes\Models\Services;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class DashboardController{

    public function dashboard(){

        $logger = new Logger('debugLog');
        $logger->pushHandler(new StreamHandler(__DIR__.'../../debug.log', Logger::DEBUG));

//        $logger->info("Arrived at dashboard Controlller");

        $pdo = App::get('pdo');

        $manifest = new Manifest();
        $currentManifests = $manifest->getCurrentManifests();
        $day = Carbon::now()->toDateString();
        $services = new Services();
        $getServices = $services->getServices($pdo);
        $customers = new Customers();
        $customerSelect = $customers->getOptionCustomers();
//        $logger->info("customers = ".print_r($getServices,true));

        return view('dashboard',['date'=>$currentManifests,'currentDay'=>$day,'services'=>$getServices,'customers'=>$customerSelect]);
//        return view('dashboard');
    }

    public function addEditWaybill(){
        $model = new Waybills();

        if (isset($_POST['editWaybill'])) {
            $model->editWaybillDashboard();
        } elseif (isset($_POST['createWaybill'])){
            $model->addWaybillDashboard();
        }

    }

}

