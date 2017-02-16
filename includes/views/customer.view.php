<?php
include "includes/views/layout/header.php";
?>
<div class="col-sm-11 main">
    <div class="row">
        <div class="col-sm-3">
            <br>
            <button data-toggle="modal" data-target="#addCustomer" class="btn btn-success col-xs-12 btn-narrow">Add New Customer</button>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-sm-12">
        <?php

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
//                redirect_to("customer.php");
            } else {
                die("Subject update failed.".mysqli_error($connection));

            }
        }


        $id = '';
        if (isset($_GET['id'])){
            $id=$_GET['id'];

            $query_result = customer($id);
            $customer = mysqli_fetch_array($query_result);

            echo '<h2>Details:</h2>';
            echo '<table class="table dataTable default">';
            echo "<tr><th>Name</th><th>Account Number</th><th>Address1</th><th>Address2</th><th>City</th><th>Country</th><th>Tel Code</th><th>Tel No</th><th>Fax Code</th><th>Fax No</th><th>Vat No</th></tr>";
            echo '<tr><td>'. $customer['comp_name']. '</td>';
            echo '<td>'.$customer['acc_no'].'</td>';
            echo '<td>'.$customer['address1'].'</td>';
            echo '<td>'.$customer['address2'].'</td>';
            echo '<td>'.$customer['city'].'</td>';
            echo '<td>'.$customer['country'].'</td>';
            echo '<td>'.$customer['codet'].'</td>';
            echo '<td>'.$customer['tel'].'</td>';
            echo '<td>'.$customer['codef'].'</td>';
            echo '<td>'.$customer['fax'].'</td>';
            echo '<td>'.$customer['vat'].'</td>';
            echo '</tr>';
//            echo '<tr><td class="edit"><a href="edit_customer.php?id='.$customer['id'].'"><input type="button" value="Edit"/></a></td>';
            echo '<tr><td class="edit"><button data-toggle="modal" data-target="#editCustomer" class="btn btn-success col-xs-12 btn-narrow">Edit Customer</button></td>';
            if (getuserfield('role') == 'admin'){
                echo '<td class="edit"><a href="del_customer?id=' .$customer['id'].'" onclick="return confirm(\'Really Delete?\');"><button class="btn btn-success col-xs-12 btn-narrow">Delete</button></a></td>';}
            echo "</tr>";
            echo '</table>';

        }
        else {
            echo '<h2>All Customers:</h2>';
            echo '<table class="table table-striped dataTable customers">
                    <thead>
                    <tr><th>Name</th><th>Account Number</th><th>Address</th><th>City</th><th>Country</th></tr>
                    </thead></table>';
        }
        require 'modals/customer.modal.php';
        ?>


        </div>
    </div>
</div>
<?php
include "includes/views/layout/footer.php";
?>

