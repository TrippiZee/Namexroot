<?php

namespace Includes\Models;
use PDO;


class Services{
    public $id;
    public $type;
    public $description;

    function getServices($pdo) {
        $statement = $pdo->prepare('SELECT * FROM services ORDER BY type');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

}