<?php

namespace includes\models;

use PDO;
use Includes\App;


class Sundries {

    public $acc_number;

    public $documentation_fee;

    public $saturday_deliveries;

    public $fuel_surcharge;

    public $freight_windhoek;

    public $freight_namibia;

    public $outlying_areas;

    public function getRecord($acc_no){
        $pdo = App::get('pdo');
        $statement = $pdo->prepare('SELECT * FROM sundries WHERE acc_number=:acc ');
        $statement->bindValue('acc',$acc_no);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);

    }

}