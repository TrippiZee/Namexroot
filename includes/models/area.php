<?php

namespace Includes\Models;
use PDO;
use Includes\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class Area {

    public $id;

    public $area;

    public function getAreas(){
        $logger = new Logger('debugLog');
        $logger->pushHandler(new StreamHandler(__DIR__.'../../debug.log', Logger::DEBUG));

        $pdo = App::get('pdo');

        $stmt = $pdo->prepare("SELECT * FROM areas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
}