<?php

namespace Includes\Models;
use PDO;
use Includes\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class Dimensions {

    public $id;

    public $waybill_no;

    public $length;

    public $width;

    public $height;

    public function calculateFreight($waybill_no){

        $logger = new Logger('debugLog');
        $logger->pushHandler(new StreamHandler(__DIR__.'../../debug.log', Logger::DEBUG));

        $waybillNo = $waybill_no;
        $pdo = App::get('pdo');

        $stmt = $pdo->prepare("SELECT * FROM dimensions WHERE waybill_no = :waybill_no");
        $stmt->bindValue('waybill_no',$waybillNo,PDO::PARAM_INT);
        $stmt->execute();
//        $logger->info("calculateFreight - ".print_r($stmt,true));
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }


}