<?php

namespace Includes\Models;

use PDO;

class Manifest
{
    public $id;

    public $manifest_no;

    public $date;

    public $reg_no;

    public $driver;

    public $co_driver;

    public $finalised;

    public $seal1;

    public $seal3;

    public $seal4;

    function getAllManifest($pdo,$columns,$request,$searchTerm){
        $statement = $pdo->prepare('SELECT * FROM manifest WHERE 1 AND ( date LIKE "'.$searchTerm.'%" OR manifest_no LIKE "'.$searchTerm.'%" OR driver LIKE "'.$searchTerm.'%" OR co_driver LIKE "'.$searchTerm.'%" OR reg_no LIKE "'.$searchTerm.'%" ) ORDER BY '.$columns[$request['order'][0]['column']].' '.$request['order'][0]['dir'].' LIMIT '.$request['start'].' ,'.$request['length'].' ');

        $statement->execute();

        $filter = $pdo->prepare('SELECT * FROM manifest WHERE 1 AND ( date LIKE "'.$searchTerm.'%" OR manifest_no LIKE "'.$searchTerm.'%" OR driver LIKE "'.$searchTerm.'%" OR co_driver LIKE "'.$searchTerm.'%" OR reg_no LIKE "'.$searchTerm.'%" )');

        $filter->execute();

        return array($statement->fetchAll(PDO::FETCH_CLASS),$filter->rowCount());
    }

}