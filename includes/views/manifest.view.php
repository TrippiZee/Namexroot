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
//                echo '<tr><td class="edit"><button data-toggle="modal" data-target="#editManifest">Edit Manifest</button></td>';
                echo '<tr><td class="edit"><a><input type="button" data-toggle="modal" data-target="#editManifest" value="Edit Manifest"/></a></td>';
        if (getuserfield('role') == 'admin'){
            echo '<td class="edit"><a href="del_manifest?id=' .$manifest['id'].'" onclick="return confirm(\'Really Delete?\');"><input type="button" value="Delete"/></a></td>';
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
            echo '<tr><td style="width:37.5%"></td><td><a><input type="button" data-toggle="modal" data-target="#addWaybill" value="Add New Waybill"/></a></td><td style="width:37.5%"></td></tr>';
            echo '<tr><br /></tr>';
            echo "</table></tr>";
            ?>

        <div id="table">
            <?php

            echo '<table class="table dataTable default manifestsWaybills">';
            echo '<h2>Waybills:</h2>';

            echo '<thead>';
            echo "<tr><th>Waybill Number</th><th>Shipper</th><th>Consignee</th><th>Qty</th><th>Weight</th><th>Type</th><th>Remarks</th><th>Edit</th><th>Delete</th><th>Create POD</th></tr>";
            echo '</thead>';
            while ($data = mysqli_fetch_assoc($manifest_query_details)) {

                echo '<tr><td class="waybillNo">'. $data['waybill_no']. '</td>';
                echo '<td class="shipper">'.$data['shipper'].'</td>';
                echo '<td class="consignee">'.$data['consignee'].'</td>';
                echo '<td class="qty">'.$data['qty'].'</td>';
                echo '<td class="weight">'.$data['weight'].'</td>';
                echo '<td class="type">'.$data['type'].'</td>';
                echo '<td class="remarks">'.$data['remarks'].'</td>';
                echo '<td class="edit editWaybill"><a><input type="button" data-toggle="modal" data-target="#editWaybill" value="Edit Waybill"/></a></td>';
                if (getuserfield('role') == 'admin'){
                    echo '<td class="edit"><a href="del_waybill?id=' .$data['id'].'" onclick="return confirm(\'Really Delete?\');"><input type="button" value="Delete"/></a></td>';}
                echo '<td class="edit"><a><input type="button" data-toggle="modal" data-target="#createPOD" value="Create POD"/></a></td></tr>';
//                echo '<tr><td class="edit"><button data-toggle="modal" data-target="#createPOD" class="btn btn-success col-xs-12 btn-narrow">Create POD</button></td></tr>';
            }
            echo '</table>';

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

            ?>
        </div>
    </div>
</div>
<?php
include "includes/views/layout/footer.php";
?>
