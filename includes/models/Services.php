<?php

namespace Includes\Models;
use PDO;
use Includes\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class Services{
    public $id;
    public $type;
    public $description;
    public $initial_rate_windhoek;
    public $over_rate_windhoek;
    public $initial_rate_namibia;
    public $over_rate_namibia;

    function getServices() {
        $pdo = App::get('pdo');

        $statement = $pdo->prepare('SELECT * FROM services ORDER BY type');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    public function getRates($area,$type)
    {
        $logger = new Logger('debugLog');
        $logger->pushHandler(new StreamHandler(__DIR__ . '../../debug.log', Logger::DEBUG));
        $pdo = App::get('pdo');
        if ($area == 'WINDHOEK') {
            $statement = $pdo->prepare('SELECT type, initial_rate_windhoek as initial, over_rate_windhoek as over FROM services WHERE type = :type');
            $statement->bindValue('type', $type, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS);
        } elseif ($area == 'NAMIBIA'){
            $statement = $pdo->prepare('SELECT type, initial_rate_namibia as initial, over_rate_namibia as over FROM services WHERE type = :type');
            $statement->bindValue('type', $type, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS);
        }
    }
}