<?php

namespace Includes\Models;

use PDO;
use Includes\App;
use Carbon\Carbon;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


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
        $pdo = App::get('pdo');
        $number = $_POST['manifest_no'];
        $date = $_POST['date'];
        $driver = strtoupper($_POST['driver']);
        $co_driver = strtoupper($_POST['co_driver']);
        $caps_reg_no = strtoupper($_POST['reg_no']);
        $reg_no = trim($caps_reg_no,"");

        $statement = $pdo->prepare("INSERT INTO manifest (manifest_no, date, driver, co_driver, reg_no, finalised) VALUES ('{$number}', '{$date}','{$driver}','{$co_driver}', '{$reg_no}','0')");
        $statement->execute();
        redirect_to('manifest?id='.$pdo->lastInsertId());
    }

    public function deleteRecord($id){

        $pdo = App::get('pdo');
        $statement = $pdo->prepare("DELETE FROM manifest WHERE id = :id LIMIT 1");
        $statement->bindValue(':id',$id,PDO::PARAM_INT);
        $statement->execute();
        redirect_to('manifest');
    }

    public function getCurrentManifests(){

        $pdo = App::get('pdo');
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

//        $statement = $pdo->prepare("SELECT * FROM manifest WHERE (date = '{$today->toDateString()}') OR (date = '{$yesterday->toDateString()}')");
        $statement = $pdo->prepare("SELECT * FROM manifest WHERE (date = :today) OR (date = :yesterday)");
        $statement->bindValue(':today',$today,PDO::PARAM_STR);
        $statement->bindValue(':yesterday',$yesterday,PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function finaliseManifest(){
        $pdo = App::get('pdo');

        $id = $_POST['id'];
        $statement = $pdo->prepare("UPDATE manifest SET finalised = 1 WHERE id = :id LIMIT 1");
        $statement->bindValue(':id',$id,PDO::PARAM_INT);
        $statement->execute();

        echo 'success';
    }

    public function addSealNumbers(){
        $logger = new Logger('debugLog');
        $logger->pushHandler(new StreamHandler(__DIR__.'../../debug.log', Logger::DEBUG));

        $pdo = App::get('pdo');

        $id = $_POST['id'];
        $seal1 = $_POST['seal1'];
        $seal2 = $_POST['seal2'];
        $seal3 = $_POST['seal3'];
        $seal4 = $_POST['seal4'];

        $logger->info("SealNumber POST = ".print_r($_POST,true));

        $statement = $pdo->prepare("UPDATE manifest SET seal1 = :seal1,seal2 = :seal2,seal3 = :seal3,seal4 = :seal4 WHERE id = :id");
        $statement->bindValue(':seal1',$seal1,PDO::PARAM_STR);
        $statement->bindValue(':seal2',$seal2,PDO::PARAM_STR);
        $statement->bindValue(':seal3',$seal3,PDO::PARAM_STR);
        $statement->bindValue(':seal4',$seal4,PDO::PARAM_STR);
        $statement->bindValue(':id',$id,PDO::PARAM_INT);
        $statement->execute();
        redirect_to('manifest?id='.$id);

    }

}