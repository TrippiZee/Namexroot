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

        $id = '';
        if (isset($_GET['id'])){
            $id=$_GET['id'];

            $query_result = customer($id);
            $customer = mysqli_fetch_array($query_result);
            $acc_number = $customer['acc_no'];

            $sundryRecord = getSundries($acc_number);
            $sundries = mysqli_fetch_array($sundryRecord);


            echo '<h2>Details:</h2>';
//            echo '<div class="table-responsive>"';
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
            echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
            if (getuserfield('role') == 'ADMIN'){
                echo '<td class="edit"><a href="del_customer?id=' .$customer['id'].'" onclick="return confirm(\'Really Delete?\');"><button class="btn btn-success col-xs-12 btn-narrow">Delete</button></a></td>';}
            echo "</tr>";

            echo '<tr><td class="edit"><button data-toggle="modal" data-target="#addRates" class="btn btn-success col-xs-12 btn-narrow">Add/Edit Rates</button></td></tr>';
            echo '</table>';
//            echo '</div>';

        }
        else {
            echo '<h2>All Customers:</h2>';
            echo '<table class="table table-striped dataTable customers">
                    <thead>
                    <tr><th>Name</th><th>Account Number</th><th>Address</th><th>City</th><th>Country</th></tr>
                    </thead></table>';
        }
        ?>
<!--        <hr>-->
<!--        <div class="row">-->
<!--        <div class="col-sm-3">-->
<!--            <br>-->
<!--            <button data-toggle="modal" data-target="#addRates" class="btn btn-success col-xs-12 btn-narrow">Add/Edit Rates</button>-->
<!--        </div>-->
<!--    </div>-->

        <?php require 'modals/customer.modal.php';
        ?>


        </div>
    </div>
</div>
<?php
include "includes/views/layout/footer.php";
?>

