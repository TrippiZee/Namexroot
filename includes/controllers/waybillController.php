<?php

namespace Includes\Controllers;
use Includes\App;
use Includes\Models\Waybills;
use Includes\Models\Customers;
use Includes\Models\Services;
use Includes\Models\Dimensions;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class WaybillController{

    public function allWaybills(){

        global $connection;

        $services = new Services();
        $getServices = $services->getServices();

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
    }

    public function calculateVolume($waybill_no){
        $modelDimensions = new Dimensions();
        $calcDimensions = $modelDimensions->calculateFreight($waybill_no);

        $cubicSubTotal = [];

        foreach ($calcDimensions as $dimension=>$value){
            $length = $value->length;
            $width = $value->width;
            $height = $value->height;

            $subTotal = $length*$width*$height;

            array_push($cubicSubTotal,$subTotal);
        }

        $freightTotal = array_sum($cubicSubTotal);

        $volume = $freightTotal/5000;

        return $volume;

    }

    public function printInvoice(){
        $docCount = $_POST['docCount'];
        $outlying = $_POST['outlying'];
        $vat = $_POST['vat'];
        $insurance = $_POST['insurance'];
        $saturday = $_POST['saturday'];

        $modelWaybill = new Waybills();
        $waybill = $modelWaybill->getWaybillDetails();

        $modelServices = new Services();

        $volume = $waybill[0]->volume;

        $weight = $waybill[0]->weight;

        if ($volume > $weight){
            $freight = $volume;
        } else {
            $freight = $weight;
        }

        $type = $waybill[0]->type;
        $area = $waybill[0]->area;
        $rates = $modelServices->getRates($area, $type);
        $initialRate = $rates[0]->initial;
        $overRate = $rates[0]->over;
        $freightCost = ($initialRate * 2) + ($freight - 2) * $overRate;

        $fuelSurcharge = $freightCost*0.12; //this should be in config somewhere

        $modelCustomer = new Customers();
        $customer = $modelCustomer->getCustomerByName();

        return pdf('print_invoice',['client'=>$customer,'waybill'=>$waybill,'docCount'=>$docCount,'outlying'=>$outlying,'vat'=>$vat,'insurance'=>$insurance,'saturday'=>$saturday,'freight'=>$freightCost,'fuelSurcharge'=>$fuelSurcharge]);
    }


    public function delWaybill(){

        $model = new Waybills();
        if (isset($_GET['id'])){
            $id=$_GET['id'];
            $model->deleteRecord($id);
        }
    }

}