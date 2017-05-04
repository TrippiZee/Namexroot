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

    public function addUser(){
        $pdo = App::get('pdo');
        $userName = strtoupper($_POST['username']);
        $password = ($_POST['password']);
        $name = strtoupper($_POST['name']);
        $surname = strtoupper($_POST['surname']);
        $role = strtoupper($_POST['role']);

        $safe_password = md5($password);

        $statement = $pdo->prepare("INSERT INTO users (username, password, name, surname, role) VALUES (:user_name, :password, :name, :surname, :role)");
        $statement->bindValue(':userName',$userName,PDO::PARAM_STR);
        $statement->bindValue(':password',$safe_password,PDO::PARAM_STR);
        $statement->bindValue(':name',$name,PDO::PARAM_STR);
        $statement->bindValue(':surname',$surname,PDO::PARAM_STR);
        $statement->bindValue(':role',$role,PDO::PARAM_STR);
        $statement->execute();
        redirect_to("user?id=".$pdo->lastInsertId());

    }

    public function editUser(){
        $pdo = App::get('pdo');
        $userName = strtoupper($_POST['username']);
        $password = $_POST['password'];
        $name = strtoupper($_POST['name']);
        $surname = strtoupper($_POST['surname']);
        $role = strtoupper($_POST['role']);
        $post_id = $_POST['id'];
        $safe_password = md5($password);


        $statement = $pdo->prepare("UPDATE users SET username = userName, password = :password, name = :name, surname = :surname, role = :role WHERE id = :post_id LIMIT 1");
        $statement->bindValue(':userName',$userName,PDO::PARAM_STR);
        $statement->bindValue(':password',$safe_password,PDO::PARAM_STR);
        $statement->bindValue(':name',$name,PDO::PARAM_STR);
        $statement->bindValue(':surname',$surname,PDO::PARAM_STR);
        $statement->bindValue(':role',$role,PDO::PARAM_STR);
        $statement->bindValue(':post_id',$post_id,PDO::PARAM_INT);
        $statement->execute();
        redirect_to("user?id=".$post_id);
    }

    public function deleteRecord($id){

        $pdo = App::get('pdo');
        $statement = $pdo->prepare("DELETE FROM users WHERE id =:id LIMIT 1");
        $statement->bindValue(':id',$id,PDO::PARAM_int);
        $statement->execute();
        redirect_to('user');
    }

    public function userMatch($userName,$password){
        $pdo = App::get('pdo');
        $statement = $pdo->prepare("SELECT id FROM users WHERE username = :userName AND password = :password");
        $statement->bindValue(':userName',$userName,PDO::PARAM_STR);
        $statement->bindValue(':password',$password,PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_CLASS);
        if ($statement->rowCount()==0){
            echo '<div id=\'message\'>Invalid username/password combination.</div>';
        }elseif ($statement->rowCount()== 1){
            $_SESSION['user_id'] = $result['id'];
            redirect_to('/');
        }

    }

}