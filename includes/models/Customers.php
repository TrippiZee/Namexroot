<?php

namespace Includes\Models;

use PDO;
use Includes\App;

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

    public function addCustomer(){
        $pdo = App::get('pdo');
        $comp_name = strtoupper($_POST['name']);
        $address1 = strtoupper($_POST['address1']);
        $address2 = strtoupper($_POST['address2']);
        $city = strtoupper($_POST['city']);
        $country = strtoupper($_POST['country']);
        $acc_no = $_POST['acc_no'];
        $codet = $_POST['codet'];
        $tel = $_POST['telno'];
        $codef = $_POST['codef'];
        $fax = $_POST['faxno'];
        $vat = $_POST['vat'];

        $statement = $pdo->prepare("INSERT INTO customers (comp_name, acc_no, address1, address2, city, country, codet, tel, codef, fax, vat) VALUES ('{$comp_name}', '{$acc_no}','{$address1}', '{$address2}', '{$city}', '{$country}', '{$codet}', '{$tel}', '{$codef}', '{$fax}', '{$vat}')");
        $statement->execute();
        redirect_to('customer');
    }

    public function editCustomer(){
        $pdo = App::get('pdo');

        $comp_name = strtoupper($_POST['name']);
        $address1 = strtoupper($_POST['address1']);
        $address2 = strtoupper($_POST['address2']);
        $city = strtoupper($_POST['city']);
        $country = strtoupper($_POST['country']);
        $accno = $_POST['acc_no'];
        $codet = $_POST['codet'];
        $tel = $_POST['telno'];
        $codef = $_POST['codef'];
        $fax = $_POST['faxno'];
        $vat = $_POST['vat'];
        $post_id = $_POST['id'];

        $statement = $pdo->prepare("UPDATE customers SET comp_name = '{$comp_name}',acc_no = '{$accno}',address1 = '{$address1}',address2 = '{$address2}',city = '{$city}',country = '{$country}',codet = '{$codet}',tel = '{$tel}',codef = '{$codef}',fax = '{$fax}',vat = '{$vat}' WHERE id = '{$post_id}' LIMIT 1");
        $statement->execute();
        redirect_to('customer?id='.$post_id);
    }

    public function deleteRecord($id){

        $pdo = App::get('pdo');
        $statement = $pdo->prepare("DELETE FROM customers WHERE id = {$id} LIMIT 1");
        $statement->execute();
        redirect_to('customer');

    }



}