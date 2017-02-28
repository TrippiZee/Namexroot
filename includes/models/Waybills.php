<?php

namespace Includes\Models;

use PDO;
use Includes\App;

class Waybills{

    public $id;

    public $manifest_no;

    public $waybill_no;

    public $date;

    public $shipper;

    public $consignee;

    public $quantity;

    public $weight;

    public $type;

    public $remarks;

    function getAllWaybills($pdo,$columns,$request,$searchTerm){
        $statement = $pdo->prepare('SELECT * FROM manifest_details WHERE 1 AND ( waybill_no LIKE "'.$searchTerm.'%" OR date LIKE "'.$searchTerm.'%" OR manifest_no LIKE "'.$searchTerm.'%" OR shipper LIKE "'.$searchTerm.'%" OR consignee LIKE "'.$searchTerm.'%" ) ORDER BY '.$columns[$request['order'][0]['column']].' '.$request['order'][0]['dir'].' LIMIT '.$request['start'].' ,'.$request['length'].' ');

        $statement->execute();

        $filter = $pdo->prepare('SELECT * FROM manifest_details WHERE 1 AND ( waybill_no LIKE "'.$searchTerm.'%" OR date LIKE "'.$searchTerm.'%" OR manifest_no LIKE "'.$searchTerm.'%" OR shipper LIKE "'.$searchTerm.'%" OR consignee LIKE "'.$searchTerm.'%" )');

        $filter->execute();

        return array($statement->fetchAll(PDO::FETCH_CLASS),$filter->rowCount());
    }

    public function getWaybillByManifestId(){
        $manifestId = $_GET['manifestId'];
        $pdo = App::get('pdo');

        $statement = $pdo->prepare('SELECT * FROM manifest_details WHERE manifest_no = "'.$manifestId.'"');
        $statement->execute();

//        return array($statement->fetchAll(PDO::FETCH_CLASS));
        $data =  $statement->fetchAll(PDO::FETCH_CLASS);
//        die(array($data));
        echo json_encode($data);

    }

    public function createPod(){
        $pdo = App::get('pdo');

        $pod = $_POST['number'];
        $date = $_POST['date'];
        $shipper = strtoupper($_POST['shipper']);
        $consignee = strtoupper($_POST['consignee']);
        $qty = $_POST['qty'];
        $type = strtoupper($_POST['type']);
        $remarks = strtoupper($_POST['remarks']);
        $weight = $_POST['weight'];
        $deldate = $_POST['deldate'];
        $signed = strtoupper($_POST['signed']);
        $time = $_POST['time'];

        $statement = $pdo->prepare("INSERT INTO pod (pod_no, date, shipper, consignee, qty, weight, type, remarks, delivery_date, signed_by, time) VALUES ('{$pod}', '{$date}', '{$shipper}', '{$consignee}', '{$qty}', '{$weight}', '{$type}', '{$remarks}', '{$deldate}', '{$signed}', '{$time}')");
        $statement->execute();
        redirect_to('pod?id='.$pdo->lastInsertId());
    }

    public function createWaybill(){
        $pdo = App::get('pdo');

        $waybill_no = $_POST['number'];
        $date = $_POST['date'];
        $shipper = strtoupper($_POST['shipper']);
        $consignee = strtoupper($_POST['consignee']);
        $qty = $_POST['qty'];
        $type = strtoupper($_POST['type']);
        $remarks = strtoupper($_POST['remarks']);
        $weight = $_POST['weight'];
        $id = $_POST['manifestId'];

        $statement = $pdo->prepare("INSERT INTO manifest_details (manifest_no, waybill_no, date, shipper, consignee, qty, weight, type, remarks) VALUES('{$id}','{$waybill_no}','{$date}','{$shipper}','{$consignee}','{$qty}','{$weight}','{$type}','{$remarks}')");
        $statement->execute();
        redirect_to("manifest?id=".$id);

    }

    public function editWaybill(){
        $pdo = App::get('pdo');

        $waybill_no = $_POST['number'];
        $date = $_POST['date'];
        $shipper = strtoupper($_POST['shipper']);
        $consignee = strtoupper($_POST['consignee']);
        $qty = $_POST['qty'];
        $type = strtoupper($_POST['type']);
        $remarks = strtoupper($_POST['remarks']);
        $weight = $_POST['weight'];
        $id = $_POST['waybillId'];
        $manifestId = &$_POST['manifestId'];

        $statement = $pdo->prepare("UPDATE manifest_details SET waybill_no = '{$waybill_no}',date = '{$date}', shipper = '{$shipper}', consignee = '{$consignee}', qty = '{$qty}', type = '{$type}',weight = '{$weight}', remarks = '{$remarks}' WHERE id = '{$id}' LIMIT 1");
        $statement->execute();
        redirect_to('manifest?id='.$manifestId);

    }

    public function editWaybillDashboard(){
        $pdo = App::get('pdo');

        $waybill_no = $_POST['number'];
        $date = $_POST['date'];
        $shipper = strtoupper($_POST['shipper']);
        $consignee = strtoupper($_POST['consignee']);
        $qty = $_POST['qty'];
        $type = strtoupper($_POST['type']);
        $remarks = strtoupper($_POST['remarks']);
        $weight = $_POST['weight'];
        $id = $_POST['waybillId'];

        $statement = $pdo->prepare("UPDATE manifest_details SET waybill_no = '{$waybill_no}',date = '{$date}', shipper = '{$shipper}', consignee = '{$consignee}', qty = '{$qty}', type = '{$type}',weight = '{$weight}', remarks = '{$remarks}' WHERE id = '{$id}' LIMIT 1");
        $statement->execute();
        redirect_to('/');
    }

    public function addWaybillDashboard(){
        $pdo = App::get('pdo');

        $waybill_no = $_POST['number'];
        $date = $_POST['date'];
        $shipper = strtoupper($_POST['shipper']);
        $consignee = strtoupper($_POST['consignee']);
        $qty = $_POST['qty'];
        $type = strtoupper($_POST['type']);
        $remarks = strtoupper($_POST['remarks']);
        $weight = $_POST['weight'];
        $id = $_POST['manifestId'];

        $statement = $pdo->prepare("INSERT INTO manifest_details (manifest_no, waybill_no, date, shipper, consignee, qty, weight, type, remarks) VALUES('{$id}','{$waybill_no}','{$date}','{$shipper}','{$consignee}','{$qty}','{$weight}','{$type}','{$remarks}')");
        $statement->execute();
        redirect_to("/");

    }

    public function deleteRecord($id){

        $pdo = App::get('pdo');
        $statement = $pdo->prepare("DELETE FROM manifest_details WHERE id = {$id} LIMIT 1");
        $statement->execute();
        redirect_to('manifest');

    }


}