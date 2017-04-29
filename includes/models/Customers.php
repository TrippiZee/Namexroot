<?php

namespace Includes\Models;

use PDO;
use Includes\App;
use includes\models\Sundries;

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

    public function getOptionCustomers(){
        $pdo = App::get('pdo');

        $stmt = $pdo->prepare("SELECT id,comp_name,acc_no FROM customers ORDER BY comp_name");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function getCustomerByName(){
        $pdo = App::get('pdo');
        $company = $_POST['debtor'];
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE comp_name = :company");
        $stmt->bindValue('company',$company,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
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

        $statement = $pdo->prepare("INSERT INTO customers (comp_name, acc_no, address1, address2, city, country, codet, tel, codef, fax, vat) VALUES (:comp_name, :acc_no,:address1, :address2, :city, :country, :codet, :tel, :codef, :fax, :vat)");
        $statement->bindValue('comp_name',$comp_name,PDO::PARAM_STR);
        $statement->bindValue('acc_no',$acc_no,PDO::PARAM_INT);
        $statement->bindValue('address1',$address1,PDO::PARAM_STR);
        $statement->bindValue('address2',$address2,PDO::PARAM_STR);
        $statement->bindValue('city',$city,PDO::PARAM_STR);
        $statement->bindValue('country',$country,PDO::PARAM_STR);
        $statement->bindValue('codet',$codet,PDO::PARAM_INT);
        $statement->bindValue('codef',$codef,PDO::PARAM_INT);
        $statement->bindValue('tel',$tel,PDO::PARAM_INT);
        $statement->bindValue('fax',$fax,PDO::PARAM_INT);
        $statement->bindValue('vat',$vat,PDO::PARAM_INT);

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
        $acc_no = $_POST['acc_no'];
        $codet = $_POST['codet'];
        $tel = $_POST['telno'];
        $codef = $_POST['codef'];
        $fax = $_POST['faxno'];
        $vat = $_POST['vat'];
        $post_id = $_POST['id'];

        $statement = $pdo->prepare("UPDATE customers SET comp_name = :comp_name,acc_no = :acc_no,address1 = :address1,address2 = :address2,city = :city,country = :country,codet = :codet,tel = :tel,codef = :codef,fax = :fax,vat = :vat WHERE id = :post_id LIMIT 1");
        $statement->bindValue('comp_name',$comp_name,PDO::PARAM_STR);
        $statement->bindValue('acc_no',$acc_no,PDO::PARAM_INT);
        $statement->bindValue('address1',$address1,PDO::PARAM_STR);
        $statement->bindValue('address2',$address2,PDO::PARAM_STR);
        $statement->bindValue('city',$city,PDO::PARAM_STR);
        $statement->bindValue('country',$country,PDO::PARAM_STR);
        $statement->bindValue('codet',$codet,PDO::PARAM_INT);
        $statement->bindValue('codef',$codef,PDO::PARAM_INT);
        $statement->bindValue('tel',$tel,PDO::PARAM_INT);
        $statement->bindValue('fax',$fax,PDO::PARAM_INT);
        $statement->bindValue('vat',$vat,PDO::PARAM_INT);
        $statement->bindValue('post_id',$post_id.PDO::PARAM_INT);

        $statement->execute();
        redirect_to('customer?id='.$post_id);
    }

    public function editRates(){
        $sundries = new Sundries();
        $exists = $sundries->getRecord($_POST['acc_no']);
        $pdo = App::get('pdo');

        $acc_number = $_POST['acc_no'];
        $id = $_POST['id'];
        $documentation_fee = $_POST['docFee'];
        $saturday_deliveries = $_POST['saturday'];
        $fuel_surcharge = $_POST['fuel'];
        $freight_windhoek = $_POST['windhoek'];
        $freight_namibia = $_POST['namibia'];
        $outlying_areas = $_POST['outlying'];

        if ($exists) {
            $stmnt = $pdo->prepare("UPDATE sundries SET documentation_fee = :doc_fee, saturday_deliveries = :saturday, fuel_surcharge = :fuel, freight_windhoek = :windhoek, freight_namibia = :namibia, outlying_areas = :outlying WHERE acc_number = :acc_no LIMIT 1");
            $stmnt->bindValue('doc_fee',$documentation_fee,PDO::PARAM_INT);
            $stmnt->bindValue('saturday',$saturday_deliveries,PDO::PARAM_INT);
            $stmnt->bindValue('fuel',$fuel_surcharge,PDO::PARAM_INT);
            $stmnt->bindValue('windhoek',$freight_windhoek,PDO::PARAM_INT);
            $stmnt->bindValue('namibia',$freight_namibia,PDO::PARAM_INT);
            $stmnt->bindValue('outlying',$outlying_areas,PDO::PARAM_INT);
            $stmnt->bindValue('acc_no',$acc_number,PDO::PARAM_INT);
            $stmnt->execute();
            redirect_to('customer?id='.$id);
        }
        if (!$exists){
            $stmnt = $pdo->prepare("INSERT INTO sundries (acc_number, documentation_fee, saturday_deliveries, fuel_surcharge, freight_windhoek, freight_namibia, outlying_areas) VALUES (:acc_no,:doc_fee,:saturday,:fuel,:windhoek,:namibia,:outlying)");
            $stmnt->bindValue('doc_fee',$documentation_fee,PDO::PARAM_INT);
            $stmnt->bindValue('saturday',$saturday_deliveries,PDO::PARAM_INT);
            $stmnt->bindValue('fuel',$fuel_surcharge,PDO::PARAM_INT);
            $stmnt->bindValue('windhoek',$freight_windhoek,PDO::PARAM_INT);
            $stmnt->bindValue('namibia',$freight_namibia,PDO::PARAM_INT);
            $stmnt->bindValue('outlying',$outlying_areas,PDO::PARAM_INT);
            $stmnt->bindValue('acc_no',$acc_number,PDO::PARAM_INT);
            $stmnt->execute();
            redirect_to('customer?id='.$id);
        }
    }

    public function deleteRecord($id,$acc){

        $pdo = App::get('pdo');
        try{
            $pdo->beginTransaction();

            $statement = $pdo->prepare("DELETE FROM customers WHERE id = :id LIMIT 1");
            $statement->bindValue('id',$id,PDO::PARAM_INT);
            $statement->execute();

            $statement = $pdo->prepare("DELETE FROM sundries WHERE acc_number = :acc LIMIT 1");
            $statement->bindValue('acc',$acc,PDO::PARAM_INT);
            $statement->execute();

            $pdo->commit();

        } catch (\PDOException $ex){
            $pdo->rollBack();
            echo $ex->getMessage();

        }
        redirect_to('customer');

    }



}