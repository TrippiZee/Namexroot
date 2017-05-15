<?php

namespace Includes\Models;

use Includes\Controllers\WaybillController;
use PDO;
use Includes\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

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

    public $location;

    public $area;

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

        $statement = $pdo->prepare('SELECT * FROM manifest_details WHERE manifest_no = :manifestId');
        $statement->bindValue(':manifestId',$manifestId,PDO::PARAM_STR);
        $statement->execute();

        $data =  $statement->fetchAll(PDO::FETCH_CLASS);
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

        $statement = $pdo->prepare("INSERT INTO pod (pod_no, date, shipper, consignee, qty, weight, type, remarks, delivery_date, signed_by, time) VALUES (:pod, :date, :shipper, :consignee, :qty, :weight, :type, :remarks, :deldate, :signed, :time)");
        $statement->bindValue(':pod',$pod,PDO::PARAM_INT);
        $statement->bindValue(':date',$date,PDO::PARAM_STR);
        $statement->bindValue(':shipper',$shipper,PDO::PARAM_STR);
        $statement->bindValue(':consignee',$consignee,PDO::PARAM_STR);
        $statement->bindValue(':qty',$qty,PDO::PARAM_INT);
        $statement->bindValue(':type',$type,PDO::PARAM_STR);
        $statement->bindValue(':remarks',$remarks,PDO::PARAM_STR);
        $statement->bindValue(':weight',$weight,PDO::PARAM_INT);
        $statement->bindValue(':deldate',$deldate,PDO::PARAM_STR);
        $statement->bindValue(':signed',$signed,PDO::PARAM_STR);
        $statement->bindValue(':time',$time,PDO::PARAM_STR);
        $statement->execute();
        redirect_to('pod?id='.$pdo->lastInsertId());
    }

    public function createWaybill(){

        $logger = new Logger('debugLog');
        $logger->pushHandler(new StreamHandler(__DIR__.'../../debug.log', Logger::DEBUG));
        $waybillController = new WaybillController();

        $pdo = App::get('pdo');

        $length=array();
        $width=array();
        $height=array();
        $waybill_no = strtoupper($_POST['number']);
        $date = $_POST['date'];
        $shipper = strtoupper($_POST['shipper']);
        $consignee = strtoupper($_POST['consignee']);
        $qty = $_POST['qty'];
        $type = strtoupper($_POST['type']);
        $remarks = strtoupper($_POST['remarks']);
        $weight = $_POST['weight'];
        $area = strtoupper($_POST['area']);
        $id = $_POST['manifestId'];
        foreach($_POST['length']as $value) {
            array_push($length,$value);
        }
        foreach($_POST['width']as $value) {
            array_push($width,$value);
        }
        foreach($_POST['height']as $value) {
            array_push($height,$value);
        }
        try{
            $pdo->beginTransaction();
            $statement = $pdo->prepare("INSERT INTO manifest_details (manifest_no, waybill_no, date, shipper, consignee, qty, weight, type, remarks, area) VALUES(:id,:waybill_no,:date,:shipper,:consignee,:qty,:weight,:type,:remarks,:area)");
            $statement->bindValue(':id',$id,PDO::PARAM_INT);
            $statement->bindValue(':waybill_no',$waybill_no,PDO::PARAM_STR);
            $statement->bindValue(':date',$date,PDO::PARAM_STR);
            $statement->bindValue(':shipper',$shipper,PDO::PARAM_STR);
            $statement->bindValue(':consignee',$consignee,PDO::PARAM_STR);
            $statement->bindValue(':qty',$qty,PDO::PARAM_INT);
            $statement->bindValue(':weight',$weight,PDO::PARAM_INT);
            $statement->bindValue(':type',$type,PDO::PARAM_STR);
            $statement->bindValue(':remarks',$remarks,PDO::PARAM_STR);
            $statement->bindValue(':area',$area,PDO::PARAM_STR);
            $statement->execute();

            $statement = $pdo->prepare("INSERT INTO dimensions (waybill_no,length,width,height) VALUES(:waybill_no,:length,:width,:height)");

            for($i=0;$i <= count($length)-1;$i++){

                $statement->bindValue(':length',$length[$i],PDO::PARAM_INT);
                $statement->bindValue(':width',$width[$i],PDO::PARAM_INT);
                $statement->bindValue(':height',$height[$i],PDO::PARAM_INT);
                $statement->bindValue(':waybill_no',$waybill_no,PDO::PARAM_STR);
                $statement->execute();
            }

            $pdo->commit();

        }catch (\PDOException $ex){
            $logger->info("Catch Ex: ".$ex);
            $pdo->rollBack();
            echo $ex->getMessage();
        }

        $calculatedVolume = $waybillController->calculateVolume($waybill_no);

        $stmnt = $pdo->prepare("UPDATE manifest_details SET volume = :volume WHERE waybill_no = :waybill_no");
        $stmnt->bindValue(':volume',$calculatedVolume,PDO::PARAM_INT);
        $stmnt->bindValue(':waybill_no',$waybill_no,PDO::PARAM_STR);
        $stmnt->execute();

        if ($_POST['createWaybill']) {
            redirect_to('manifest?id=' . $id);
        }elseif ($_POST['createWaybillDash']){
            redirect_to('/');
        }

    }

    public function editWaybill(){
        $pdo = App::get('pdo');

        $waybill_no = strtoupper($_POST['number']);
        $date = $_POST['date'];
        $shipper = strtoupper($_POST['shipper']);
        $consignee = strtoupper($_POST['consignee']);
        $qty = $_POST['qty'];
        $type = strtoupper($_POST['type']);
        $remarks = strtoupper($_POST['remarks']);
        $weight = $_POST['weight'];
        $area = strtoupper($_POST['area']);
        $id = $_POST['waybillId'];
        $manifestId = &$_POST['manifestId'];

        $statement = $pdo->prepare("UPDATE manifest_details SET waybill_no = :waybill_no,date = :date, shipper = :shipper, consignee = :consignee, qty = :qty, type = :type,weight = :weight, remarks = :remarks,area = :area WHERE id = :id LIMIT 1");

        $statement->bindValue(':waybill_no',$waybill_no,PDO::PARAM_STR);
        $statement->bindValue(':date',$date,PDO::PARAM_STR);
        $statement->bindValue(':shipper',$shipper,PDO::PARAM_STR);
        $statement->bindValue(':consignee',$consignee,PDO::PARAM_STR);
        $statement->bindValue(':qty',$qty,PDO::PARAM_INT);
        $statement->bindValue(':weight',$weight,PDO::PARAM_INT);
        $statement->bindValue(':type',$type,PDO::PARAM_STR);
        $statement->bindValue(':remarks',$remarks,PDO::PARAM_STR);
        $statement->bindValue(':area',$area,PDO::PARAM_STR);
        $statement->bindValue(':id',$id,PDO::PARAM_INT);
        $statement->execute();

        if ($_POST['editWaybill']) {
            redirect_to('manifest?id=' . $manifestId);
        }elseif ($_POST['editWaybillDash']){
            redirect_to('/');
        }
    }

    public function updateLocation(){
        $pdo = App::get('pdo');

        $location = strtoupper($_POST['location']);
        $id = $_POST['id'];

        $statement = $pdo->prepare("UPDATE manifest_details SET location = :location WHERE id = :id LIMIT 1");
        $statement->bindValue(':location',$location,PDO::PARAM_STR);
        $statement->bindValue(':id',$id,PDO::PARAM_INT);
        $statement->execute();
        redirect_to('/');
    }

    public function getDebtors(){
        $id = $_GET['id'];
        $pdo = App::get('pdo');

        $stmt = $pdo->prepare("SELECT * FROM manifest_details WHERE id = :id");
        $stmt->bindValue('id',$id,PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);
        echo json_encode($data);
    }

    public function getWaybillDetails(){
        $id = $_POST['waybillId'];
        $pdo = App::get('pdo');

        $stmt = $pdo->prepare("SELECT waybill_no,qty,weight,volume,type,area FROM manifest_details WHERE id = :id");
        $stmt->bindValue('id',$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function deleteRecord($id){

        $pdo = App::get('pdo');
        $statement = $pdo->prepare("DELETE FROM manifest_details WHERE id = :id LIMIT 1");
        $statement->bindValue(':id',$id,PDO::PARAM_INT);

        $statement->execute();
        redirect_to('manifest');
    }
}