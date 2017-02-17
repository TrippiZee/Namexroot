<?php

namespace Includes\Controllers;

use Includes\App;
use Includes\Models\Customers;

class CustomerController {

    public function allCustomers(){


        return view('customer');
    }

    public function filterCustomers(){

        $pdo = App::get('pdo');
        $customer = new Customers();
        $tableRequest = $_REQUEST;
        $columns = array(
            0 => 'comp_name',
            1 => 'acc_no',
            2 => 'address1',
            3 => 'city',
            4 => 'country',
        );
        $searchTerm = $_REQUEST['search']['value'];

        $totalRows = $pdo->query('select count(*) from customers')->fetchColumn();
        list($tableData,$rowCount) = $customer->getAllCustomers($pdo,$columns,$tableRequest,$searchTerm);

        $customers = array();

        foreach ($tableData as $row){
            $nestedData = array();
            $nestedData[] = "<a href='customer?id=".$row->id."'>".$row->comp_name."</a>";
            $nestedData[] = $row->acc_no;
            $nestedData[] = $row->address1;
            $nestedData[] = $row->city;
            $nestedData[] = $row->country;

            $customers[] = $nestedData;
        }

        $totalFiltered = $rowCount;

        $json_data = array(
            "draw"            => intval( $tableRequest['draw'] ),
            "recordsTotal"    => intval( $totalRows ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $customers
        );

        echo json_encode($json_data);
    }

    public function addEditCustomer(){
        global $connection;

        if (isset($_POST['add'])) {

            $comp_name = strtoupper($_POST['name']);
            $address1 = strtoupper($_POST['address1']);
            $address2 = strtoupper($_POST['address2']);
            $city = strtoupper($_POST['city']);
            $country = strtoupper($_POST['country']);
            $acc_no = $_POST['acc_no'];
            $codet = $_POST['codet'];
            $tel = $_POST['telno'];
            $codef = $_POST['codef'];
            $fax = $_POST['faxno'];
            $vat = $_POST['vat'];


            $query  = "INSERT INTO customers (";
            $query .= "  comp_name, acc_no, address1, address2, city, country, codet, tel, codef, fax, vat";
            $query .= ") VALUES (";
            $query .= "  '{$comp_name}', '{$acc_no}','{$address1}', '{$address2}', '{$city}', '{$country}', '{$codet}', '{$tel}', '{$codef}', '{$fax}', '{$vat}'";
            $query .= ")";
            $result = mysqli_query($connection, $query);

            if ($result) {
                // Success
                redirect_to("customer?id=".mysqli_insert_id($connection));
            } else {
                // Failure
                echo 'Failed';
                die("Subject update failed.".mysqli_error($connection));

            }
        }

        if (isset($_POST['edit'])) {

            $comp_name = strtoupper($_POST['name']);
            $address1 = strtoupper($_POST['address1']);
            $address2 = strtoupper($_POST['address2']);
            $city = strtoupper($_POST['city']);
            $country = strtoupper($_POST['country']);
            $accno = $_POST['acc_no'];
            $codet = $_POST['codet'];
            $tel = $_POST['telno'];
            $codef = $_POST['codef'];
            $fax = $_POST['faxno'];
            $vat = $_POST['vat'];
            $post_id = $_POST['id'];

            $update_query  = "UPDATE customers SET ";
            $update_query .= "comp_name = '{$comp_name}', ";
            $update_query .= "acc_no = '{$accno}', ";
            $update_query .= "address1 = '{$address1}', ";
            $update_query .= "address2 = '{$address2}', ";
            $update_query .= "city = '{$city}', ";
            $update_query .= "country = '{$country}', ";
            $update_query .= "codet = '{$codet}', ";
            $update_query .= "tel = '{$tel}', ";
            $update_query .= "codef = '{$codef}', ";
            $update_query .= "fax = '{$fax}', ";
            $update_query .= "vat = '{$vat}' ";
            $update_query .= "WHERE id = '{$post_id}' ";
            $update_query .= "LIMIT 1";
            $result = mysqli_query($connection,$update_query);
            if ($result && mysqli_affected_rows($connection) >= 0) {
                // Success
                redirect_to("customer?id=".$post_id);
            } else {
                die("Subject update failed.".mysqli_error($connection));

            }
        }

    }

    public function delCustomer(){

        $model = new Customers();
        if (isset($_GET['id'])){
            $id=$_GET['id'];
            $model->deleteRecord($id);
        }
    }

}
