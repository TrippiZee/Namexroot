<?php

namespace Includes\Controllers;

use Includes\App;
use Includes\Models\User;

class SystemController{

    public static function loggedIn(){
        if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
            return true;
        }else {
            return false;
        }
    }

    public function checkUser(){
        $model = new User();
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $password_hash = md5($password);

//            if (!empty($username)&&!empty($password)) {
                $model->userMatch($username,$password_hash);
            }
        else {
                echo "Please enter a username and password";
            }
//        }
    }

    public function logout(){

        session_destroy();
        redirect_to('/');

    }
}