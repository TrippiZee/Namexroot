<?php

namespace Includes\Controllers;

use Includes\App;
use Includes\Models\Pod;
use Includes\Models\Services;


class PodController{

    public function allPods(){

        global $connection;
        $pdo = App::get('pdo');

        $services = new Services();
        $getServices = $services->getServices($pdo);


        return view('pod',['connection'=>$connection,'services'=>$getServices]);

    }

    public function filterPods(){
        $pdo = App::get('pdo');
        $podModel = new Pod();

        $tableRequest = $_REQUEST;

        $columns = array(
            0 => 'pod_no',
            1 => 'date',
            2 => 'shipper',
            3 => 'consignee',
        );
        $searchTerm = $_REQUEST['search']['value'];


        $totalRows = $pdo->query('select count(*) from pod')->fetchColumn();
        list($tableData,$rowCount) = $podModel->getAllPod($pdo,$columns,$tableRequest,$searchTerm);

        $pod = array();

        foreach ($tableData as $row){
            $nestedData = array();
            $nestedData[] = "<a href='pod?id=".$row->id."'>".$row->pod_no."</a>";
            $nestedData[] = $row->date;
            $nestedData[] = $row->shipper;
            $nestedData[] = $row->consignee;

            $pod[] = $nestedData;
        }

        $totalFiltered = $rowCount;

        $json_data = array(
            "draw"            => intval( $tableRequest['draw'] ),
            "recordsTotal"    => intval( $totalRows ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $pod
        );

        echo json_encode($json_data);

    }

    public function addEditPod(){
        $model = new Pod();
        if (isset($_POST['editPod'])) {
            $model->editPod();
        }
    }

    public function delPod(){

        $model = new Pod();
        if (isset($_GET['id'])){
            $id=$_GET['id'];
            $model->deleteRecord($id);
        }
    }


}