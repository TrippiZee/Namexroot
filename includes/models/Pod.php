<?php

namespace Includes\Models;
use PDO;

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

}