<?php
namespace Includes\Controllers;
use Includes\App;
use Includes\Models\Manifest;
use Includes\Models\Services;
use Includes\Models\Area;
use Includes\Models\Customers;

class ManifestController {

    public function allManifests(){
//        $connection = App::get('connection');
        global $connection;
        $pdo = App::get('pdo');
        $services = new Services();
        $getServices = $services->getServices($pdo);
        $customers = new Customers();
        $customerSelect = $customers->getOptionCustomers();
        $area = new Area();
        $allAreas = $area->getAreas();

        return view('manifest',['services'=>$getServices,'connection'=>$connection,'customers'=>$customerSelect,'areas'=>$allAreas]);
    }

    public function printManifest(){
        global $connection;
        return pdf('print_manifest',['connection'=>$connection]);
    }

    public function filterManifests()
    {

        $pdo = App::get('pdo');
        $manifest = new Manifest();
        $tableRequest = $_REQUEST;

        $columns = array(
            0 => 'date',
            1 => 'manifest_no',
            2 => 'driver',
            3 => 'co_driver',
            4 => 'reg_no',
        );
        $searchTerm = $_REQUEST['search']['value'];


        $totalRows = $pdo->query('select count(*) from manifest')->fetchColumn();
        list($tableData, $rowCount) = $manifest->getAllManifest($pdo, $columns, $tableRequest, $searchTerm);

        $manifests = array();

        foreach ($tableData as $row) {
            $nestedData = array();
            $nestedData[] = $row->date;
            $nestedData[] = "<a href='manifest?id=" . $row->id . "'>" . $row->manifest_no . "</a>";
            $nestedData[] = $row->driver;
            $nestedData[] = $row->co_driver;
            $nestedData[] = $row->reg_no;

            $manifests[] = $nestedData;
        }

        $totalFiltered = $rowCount;

        $json_data = array(
            "draw" => intval($tableRequest['draw']),
            "recordsTotal" => intval($totalRows),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $manifests
        );

        echo json_encode($json_data);
    }

    public function addEditManifest(){
        $model = new Manifest();

        if (isset($_POST['editManifest'])) {
            $model->editManifest();
        } elseif (isset($_POST['addManifest'])){
            $model->addManifest();
        }
    }

    public function finalise(){
        $model = new Manifest();
        if (isset($_POST['id'])) {
            $model->finaliseManifest();
            }
        }

    public function delManifest(){

        $model = new Manifest();
        if (isset($_GET['id'])){
            $id=$_GET['id'];
            $model->deleteRecord($id);
        }
    }
}