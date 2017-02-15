<?php
include "includes/views/layout/header.php";
?>
<div class="col-sm-11 main">
    <div class="row">
        <div class="col-sm-3">
            <br>
            <button data-toggle="modal" data-target="#addManifest" class="btn btn-success col-xs-12 btn-narrow">Add New Manifest</button>
        </div>
    </div>
    <hr>
<div class="row">
    <div class="col-sm-12">

        <?php
        if (isset($_POST['editManifest'])) {

            $number = $_POST['number'];
            $date = $_POST['date'];
            $driver = strtoupper($_POST['driver']);
            $post_id = $_POST['id'];
            $co_driver = strtoupper($_POST['co_driver']);
            $caps_reg_no = strtoupper($_POST['reg_no']);
            $reg_no = trim($caps_reg_no,"");

            $update_query  = "UPDATE manifest SET ";
            $update_query .= "manifest_no = '{$number}', ";
            $update_query .= "date = '{$date}', ";
            $update_query .= "driver = '{$driver}', ";
            $update_query .= "co_driver = '{$co_driver}', ";
            $update_query .= "reg_no = '{$reg_no}' ";
            $update_query .= "WHERE id = '{$post_id}' ";
            $update_query .= "LIMIT 1";
            $result = mysqli_query($connection,$update_query);
            if ($result && mysqli_affected_rows($connection) >= 0) {
                // Success
                redirect_to("manifest.php?id=".$post_id);
            } else {
                die("Subject update failed.".mysqli_error($connection));

            }
        }

        if (isset($_GET['id'])){
            $id=$_GET['id'];

            $query_result = manifest($id);
            $manifest = mysqli_fetch_array($query_result);


            echo '<h2>Details:</h2>';
            echo '<table class="table dataTable default">';
            echo "<tr><th>Date</th><th>Manifest No</th><th>Driver</th><th>Co-Driver</th><th>Reg No</th></tr>";

            echo '<tr><td>'. $manifest['date']. '</td>';
            echo '<td>'.$manifest['manifest_no'].'</td>';
            echo '<td>'.$manifest['driver'].'</td>';
            echo '<td>'.$manifest['co_driver'].'</td>';
            echo '<td>'.$manifest['reg_no'].'</td></tr>';
            if ($manifest['finalised'] == '0') {
            echo '<tr><td class="edit"><button data-toggle="modal" data-target="#editManifest" class="btn btn-success col-xs-12 btn-narrow">Edit Manifest</button></td>';
//            echo '<tr><td class="edit"><a href="../../edit_manifest.php?id=' .$manifest['id'].'"><input type="button" value="Edit"/></a></td>';
        if (getuserfield('role') == 'admin'){
            echo '<td class="edit"><a href="del_manifest.php?id=' .$manifest['id'].'" onclick="return confirm(\'Really Delete?\');"><input type="button" value="Delete"/></a></td>';
        }
            echo "</tr>";}


            $manifest_id = $manifest['id'];

            $query = 'SELECT * ';
            $query .= 'FROM manifest_details ';
            $query .= "WHERE manifest_no = {$manifest_id}";

            $manifest_query_details = mysqli_query($connection,$query);

            $sum_qty = quantity($manifest_id);
            $qty = mysqli_fetch_array($sum_qty);
            $sum_weight = weight($manifest_id);
            $weight = mysqli_fetch_array($sum_weight);
            $sum_overnight = overnight($manifest_id);
            $overnight = mysqli_fetch_array($sum_overnight);
            $sum_budget = budget($manifest_id);
            $budget = mysqli_fetch_array($sum_budget);
            $sum_consol = consol($manifest_id);
            $consol = mysqli_fetch_array($sum_consol);
            $sum_economy = economy($manifest_id);
            $economy = mysqli_fetch_array($sum_economy);

            echo '<table class="table dataTable default" >';
            echo '<tr><td style="width:470px"></td><td><a href="../../new_waybill.php?id=' .$manifest_id.'"><input type="button" value="Add New Waybill"/></a> </td></tr>';
            echo '<tr><br /></tr>';
            echo "</table></tr>";
            ?>
        <div id="table">
            <?php

            echo '<tr><table class="table dataTable default">';
            echo '<h2>Waybills:</h2>';

            echo "<tr><th>Waybill Number</th><th>Shipper</th><th>Consignee</th><th>Qty</th><th>Weight</th><th>Type</th><th>Remarks</th></tr>";
            while ($data = mysqli_fetch_assoc($manifest_query_details)) {

                echo '<tr><td>'. $data['waybill_no']. '</td>';
                echo '<td>'.$data['shipper'].'</td>';
                echo '<td>'.$data['consignee'].'</td>';
                echo '<td>'.$data['qty'].'</td>';
                echo '<td>'.$data['weight'].'</td>';
                echo '<td>'.$data['type'].'</td>';
                echo '<td>'.$data['remarks'].'</td>';
                echo '<td style="visibility: hidden">'.$data['date'].'</td></tr>';
                echo '<tr><td class="edit"><a href="../../edit_waybill.php?id=' .$data['id'].'& shipper='.$data['shipper'].'& type='.$data['type'].'"><input type="button" value="Edit"/></a></td>';
                if (getuserfield('role') == 'admin'){
                    echo '<td class="edit"><a href="del_waybill.php?id=' .$data['id'].'" onclick="return confirm(\'Really Delete?\');"><input type="button" value="Delete"/></a></td>';}
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<tr><td class="edit"><button data-toggle="modal" data-target="#createPOD" class="btn btn-success col-xs-12 btn-narrow">Create POD</button></td></tr>';
            }

            echo '<table class="table dataTable default">';
            echo '<h2>Seal Numbers:</h2>';
            echo "<tr><th>Seal1</th><th>Seal2</th><th>Seal3</th><th>Seal4</th></tr>";

            echo '<tr><td>'.$manifest['seal1']. '</td>';
            echo '<td>'.$manifest['seal2'].'</td>';
            echo '<td>'.$manifest['seal3'].'</td>';
            echo '<td>'.$manifest['seal4'].'</td></tr>';
            echo '<tr><td class="edit"><a href="sealnumbers.php?id='.$manifest['id'].'"><input type="button" value="Add/Edit Seal Nr"/></a></td></tr>';

            echo '</table>';

        echo '<table class="table dataTable default">';
                echo '<tr><th>Total Quantity</th><th>Total Weight</th><th>Overnight</th><th>Budget</th><th>Consolidated</th><th>Economy</th></tr>';
                echo '<tr><td>'.$qty['SUM(qty)'].'</td><td>'.$weight['SUM(weight)'].'</td><td>'.$overnight['SUM(weight)'].'</td><td>'.$budget['SUM(weight)'].'</td><td>'.$consol['SUM(weight)'].'</td><td>'.$economy['SUM(weight)'].'</td></tr>';

                echo '<tr></tr>';
                echo '<tr></tr>';
                echo '<tr></tr>';

                echo '<tr><td><a href="print_manifest?print_id=' .$manifest_id.'" target="_BLANK"><input type="button" value="PRINT"/></a> </td></tr>';
                echo '<tr><br /></tr>';
                echo '<tr><br /></tr>';
                echo '<tr><br /></tr>';
                echo "</table>";
            echo'</div>';
        }
         else {
             echo '<table class="table table-striped dataTable manifests">
                    <thead>
                    <tr><th>Date</th><th>Manifest No</th><th>Driver</th><th>Co-Driver</th><th>Reg No</th></tr>
                    </thead></table>';
         }
            require 'modals/manifest.modal.php';
            require 'modals/waybill.modal.php';

            ?>
        </div>
    </div>
</div>
<?php
include "includes/views/layout/footer.php";
?>
