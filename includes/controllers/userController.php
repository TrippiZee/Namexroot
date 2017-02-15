<?php

namespace Includes\Controllers;
use Includes\App;
use Includes\Models\User;
use Includes\Models\UserRole;


class UserController{

    public function allUsers(){

        global $connection;
        $pdo = App::get('pdo');
        $userRole = new UserRole();
        $getRole = $userRole->user_role($pdo);

        return view('user',['roles'=>$getRole,'connection'=>$connection]);
    }

    public function filterUsers(){
        $pdo = App::get('pdo');
        $userModel = new User();


        $tableRequest = $_REQUEST;
        $columns = array(
            0 => 'username',
            1 => 'name',
            2 => 'surname',
            3 => 'role',
        );
        $searchTerm = $_REQUEST['search']['value'];

        $totalRows = $pdo->query('select count(*) from users')->fetchColumn();
        list($tableData,$rowCount) = $userModel->getAllUsersAjax($pdo,$columns,$tableRequest,$searchTerm);

        $users = array();

        foreach ($tableData as $row){
            $nestedData = array();
            $nestedData[] = "<a href='user?id=".$row->id."'>".$row->username."</a>";
            $nestedData[] = $row->name;
            $nestedData[] = $row->surname;
            $nestedData[] = $row->role;

            $users[] = $nestedData;
        }

        $totalFiltered = $rowCount;

        $json_data = array(
            "draw"            => intval( $tableRequest['draw'] ),
            "recordsTotal"    => intval( $totalRows ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $users
        );

        echo json_encode($json_data);

    }
}