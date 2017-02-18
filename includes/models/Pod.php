<?php

namespace Includes\Models;
use PDO;
use Includes\App;

class Pod
{
    public $id;
    public $pod_no;
    public $date;
    public $shipper;
    public $consignee;
    public $qty;
    public $weight;
    public $type;
    public $remarks;
    public $delivery_date;
    public $signed_by;
    public $time;

    function getAllPod($pdo,$columns,$request,$searchTerm){
        $statement = $pdo->prepare('SELECT * FROM pod WHERE 1 AND ( pod_no LIKE "'.$searchTerm.'%" OR date LIKE "'.$searchTerm.'%" OR shipper LIKE "'.$searchTerm.'%" OR consignee LIKE "'.$searchTerm.'%" ) ORDER BY '.$columns[$request['order'][0]['column']].' '.$request['order'][0]['dir'].' LIMIT '.$request['start'].' ,'.$request['length'].' ');

        $statement->execute();

        $filter = $pdo->prepare('SELECT * FROM pod WHERE 1 AND ( pod_no LIKE "'.$searchTerm.'%" OR date LIKE "'.$searchTerm.'%" OR shipper LIKE "'.$searchTerm.'%" OR consignee LIKE "'.$searchTerm.'%" )');

        $filter->execute();

        return array($statement->fetchAll(PDO::FETCH_CLASS),$filter->rowCount());
    }

    public function editPod(){
        $pdo = App::get('pdo');
        $pod_no = $_POST['number'];
        $date = $_POST['date'];
        $shipper = strtoupper($_POST['shipper']);
        $consignee = strtoupper($_POST['consignee']);
        $qty = strtoupper($_POST['qty']);
        $weight = $_POST['weight'];
        $type = strtoupper($_POST['type']);
        $remarks = strtoupper($_POST['remarks']);
        $delivery = $_POST['delivery'];
        $signed = strtoupper($_POST['signed']);
        $time = $_POST['time'];
        $post_id = $_POST['id'];

        $statement = $pdo->prepare("UPDATE pod SET pod_no = '{$pod_no}',date = '{$date}',shipper = '{$shipper}',consignee = '{$consignee}',qty = '{$qty}',weight = '{$weight}',type = '{$type}',remarks = '{$remarks}',delivery_date = '{$delivery}',signed_by = '{$signed}',time = '{$time}' WHERE id = '{$post_id}' LIMIT 1");
        $statement->execute();
        redirect_to('pod?id='.$post_id);

    }

    public function deleteRecord($id){

        $pdo = App::get('pdo');
        $statement = $pdo->prepare("DELETE FROM pod WHERE id = {$id} LIMIT 1");
        $statement->execute();
        redirect_to('pod');

    }


}