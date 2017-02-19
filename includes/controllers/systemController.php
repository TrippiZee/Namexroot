<?php

namespace Includes\Controllers;

use Includes\App;

class SystemController{

    public function logout(){

        session_destroy();
        redirect_to('/');

    }
}