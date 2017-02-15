<?php

namespace Includes\Models;
use PDO;


class UserRole
{
    public $id;
    public $role;

    function user_role($pdo) {
        $statement = $pdo->prepare('SELECT * FROM users_role ORDER BY role');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

}