<?php

namespace Includes\Controllers;
use Includes\App;
use Includes\Models\Waybills;
use Includes\Models\Customers;
use Includes\Models\Services;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class WaybillController{

    public function allWaybills(){

        global $connection;

        $pdo = App::get('pdo');
        $services = new Services();
        $getServices = $services->getServices($pdo);

        return view('waybill',['services'=>$getServices,'connection'=>$connection]);
    }


    public function filterWaybills(){

        $pdo = App::get('pdo');
        $waybill = new Waybills();

        $tableRequest = $_REQUEST;

        $columns = array(
            0 => 'date',
            1 => 'waybill_no',
            2 => 'manifest_no',
            3 => 'shipper',
            4 => 'consignee',
        );
        $searchTerm = $_REQUEST['search']['value'];

        $totalRows = $pdo->query('select count(*) from manifest_details')->fetchColumn();
        list($tableData,$rowCount) = $waybill->getAllWaybills($pdo,$columns,$tableRequest,$searchTerm);

        $waybills = array();

        foreach ($tableData as $row){
            $nestedData = array();
            $nestedData[] = $row->date;
            $nestedData[] = "<a href='waybill?id=".$row->id."'>".$row->waybill_no."</a>";
            $nestedData[] = $row->manifest_no;
            $nestedData[] = $row->shipper;
            $nestedData[] = $row->consignee;

            $waybills[] = $nestedData;
        }

        $totalFiltered = $rowCount;

        $json_data = array(
            "draw"            => intval( $tableRequest['draw'] ),
            "recordsTotal"    => intval( $totalRows ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $waybills
        );

        echo json_encode($json_data);

    }

    public function addEditWaybill(){
        $model = new Waybills();

        if (isset($_POST['createPOD'])) {
            $model->createPod();
        }
        elseif (isset($_POST['createWaybill']) || isset($_POST['createWaybillDash'])) {
            $model->createWaybill();
        }
        if (isset($_POST['editWaybill']) || isset($_POST['editWaybillDash'])) {
            $model->editWaybill();
        }
    }

    public function getManifestWaybillsDashboard(){

        $model = new Waybills();
        $model->getWaybillByManifestId();

    }

    public function updateLocation(){
        $model = new Waybills();
        $model->updateLocation();
    }

    public function getDebtorsByWaybill(){
        $logger = new Logger('debugLog');
        $logger->pushHandler(new StreamHandler(__DIR__.'../../debug.log', Logger::DEBUG));

        $model = new Waybills();
        $model->getDebtors();
//        $logger->info("Data = ".print_r($data,true));

    }

    public function printInvoice(){
        $logger = new Logger('debugLog');
        $logger->pushHandler(new StreamHandler(__DIR__.'../../debug.log', Logger::DEBUG));

        $docCount = $_POST['docCount'];
        $outlying = $_POST['outlying'];
        $vat = $_POST['vat'];
        $insurance = $_POST['insurance'];
        $saturday = $_POST['saturday'];

        $modelWaybill = new Waybills();
        $waybill = $modelWaybill->getWaybillDetails();

        $modelCustomer = new Customers();
        $customer = $modelCustomer->getCustomerByName();

//        $logger->info("Data = ".print_r($_POST,true));
        $logger->info("Data = ".print_r($waybill,true));
        return pdf('print_invoice',['client'=>$customer,'waybill'=>$waybill,'docCount'=>$docCount,'outlying'=>$outlying,'vat'=>$vat,'insurance'=>$insurance,'saturday'=>$saturday]);
    }


    public function delWaybill(){

        $model = new Waybills();
        if (isset($_GET['id'])){
            $id=$_GET['id'];
            $model->deleteRecord($id);
        }
    }

}