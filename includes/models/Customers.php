<?php

namespace Includes\Models;

use PDO;

class Customers{

    public $id;

    public $comp_name;

    public $acc_no;

    public $address1;

    public $address2;

    public $city;

    public $country;

    public $codet;

    public $tel;

    public $codef;

    public $fax;

    public $vat;

    public function getAllCustomers($pdo,$columns,$request,$searchTerm){
        $statement = $pdo->prepare('SELECT * FROM customers WHERE 1 AND ( comp_name LIKE "'.$searchTerm.'%" OR acc_no LIKE "'.$searchTerm.'%" OR address1 LIKE "'.$searchTerm.'%" OR city LIKE "'.$searchTerm.'%" OR country LIKE "'.$searchTerm.'%" ) ORDER BY '.$columns[$request['order'][0]['column']].' '.$request['order'][0]['dir'].' LIMIT '.$request['start'].' ,'.$request['length'].' ');

        $statement->execute();

        $filter = $pdo->prepare('SELECT * FROM customers WHERE 1 AND ( comp_name LIKE "'.$searchTerm.'%" OR acc_no LIKE "'.$searchTerm.'%" OR address1 LIKE "'.$searchTerm.'%" OR city LIKE "'.$searchTerm.'%" OR country LIKE "'.$searchTerm.'%" )');

        $filter->execute();

        return array($statement->fetchAll(PDO::FETCH_CLASS),$filter->rowCount());
    }


}