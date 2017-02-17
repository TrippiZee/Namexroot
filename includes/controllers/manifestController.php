<?php
namespace Includes\Controllers;
use Includes\App;
use Includes\Models\Manifest;


class ManifestController {

    public function allManifests(){
//        $connection = App::get('connection');
        global $connection;
        return view('manifest',['connection'=>$connection]);
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
        global $connection;

        if (isset($_POST['editManifest'])) {

            $number = $_POST['manifest_no'];
            $date = $_POST['date'];
            $driver = strtoupper($_POST['driver']);
            $post_id = $_POST['id'];
            $co_driver = strtoupper($_POST['co_driver']);
            $caps_reg_no = strtoupper($_POST['reg_no']);
            $reg_no = trim($caps_reg_no,"");

            $update_query  = "UPDATE manifest SET ";
            $update_query .= "manifest_no = '{$number}', ";
            $update_query .= "date = '{$date}', ";
            $update_query .= "driver = '{$driver}', ";
            $update_query .= "co_driver = '{$co_driver}', ";
            $update_query .= "reg_no = '{$reg_no}' ";
            $update_query .= "WHERE id = '{$post_id}' ";
            $update_query .= "LIMIT 1";
            $result = mysqli_query($connection,$update_query);
            if ($result && mysqli_affected_rows($connection) >= 0) {
                // Success
                redirect_to("manifest?id=".$post_id);
            } else {
                die("Subject update failed.".mysqli_error($connection));

            }
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