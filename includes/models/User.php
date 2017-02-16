<?php

namespace Includes\Models;
use PDO;
use Includes\App;

class User
{
    public $id;
    public $username;
    public $password;
    public $name;
    public $surname;
    public $role;

    function getAllUsersAjax($pdo,$columns,$request,$searchTerm){
        $statement = $pdo->prepare('SELECT * FROM users WHERE 1 AND ( username LIKE "'.$searchTerm.'%" OR name LIKE "'.$searchTerm.'%" OR surname LIKE "'.$searchTerm.'%" OR role LIKE "'.$searchTerm.'%" ) ORDER BY '.$columns[$request['order'][0]['column']].' '.$request['order'][0]['dir'].' LIMIT '.$request['start'].' ,'.$request['length'].' ');

        $statement->execute();

        $filter = $pdo->prepare('SELECT * FROM users WHERE 1 AND ( username LIKE "'.$searchTerm.'%" OR name LIKE "'.$searchTerm.'%" OR surname LIKE "'.$searchTerm.'%" OR role LIKE "'.$searchTerm.'%" )');

        $filter->execute();

        return array($statement->fetchAll(PDO::FETCH_CLASS),$filter->rowCount());
    }

    public function deleteRecord($id){

        $pdo = App::get('pdo');
        $statement = $pdo->prepare("DELETE FROM users WHERE id = {$id} LIMIT 1");
        $statement->execute();
        redirect_to('user');

    }


}