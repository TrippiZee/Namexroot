<?php

namespace Includes\Models;

use PDO;
use Includes\App;

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

    public function editManifest(){

        $pdo = App::get('pdo');
        $number = $_POST['manifest_no'];
        $date = $_POST['date'];
        $driver = strtoupper($_POST['driver']);
        $post_id = $_POST['id'];
        $co_driver = strtoupper($_POST['co_driver']);
        $caps_reg_no = strtoupper($_POST['reg_no']);
        $reg_no = trim($caps_reg_no,"");

        $statement = $pdo->prepare("UPDATE manifest SET manifest_no = '{$number}',date = '{$date}',driver = '{$driver}',co_driver = '{$co_driver}',
                      reg_no = '{$reg_no}' WHERE id = '{$post_id}' LIMIT 1");
        $statement->execute();
        redirect_to('manifest?id='.$post_id);

    }

    public function addManifest(){

    }

    public function deleteRecord($id){

        $pdo = App::get('pdo');
        $statement = $pdo->prepare("DELETE FROM manifest WHERE id = {$id} LIMIT 1");
        $statement->execute();
        redirect_to('manifest');

    }
}