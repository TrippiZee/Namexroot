<?php
include "layout/header.php";
?>
<div class="col-sm-11 main">
    <div class="row">
        <div class="col-sm-12">
        <?php

        if (isset($_POST['createPOD'])) {

            $pod = $_POST['number'];
            $date = $_POST['date'];
            $shipper = strtoupper($_POST['shipper']);
            $consignee = strtoupper($_POST['consignee']);
            $qty = $_POST['qty'];
            $type = strtoupper($_POST['type']);
            $remarks = strtoupper($_POST['remarks']);
            $weight = $_POST['weight'];
            $deldate = $_POST['deldate'];
            $signed = strtoupper($_POST['signed']);
            $time = $_POST['time'];



            $query  = "INSERT INTO pod (";
            $query .= "  pod_no, date, shipper, consignee, qty, weight, type, remarks, delivery_date, signed_by, time";
            $query .= ") VALUES (";
            $query .= " '{$pod}', '{$date}', '{$shipper}', '{$consignee}', '{$qty}', '{$weight}', '{$type}', '{$remarks}', '{$deldate}', '{$signed}', '{$time}'";
            $query .= ")";
            $result = mysqli_query($connection, $query);

            if ($result) {
                // Success
                redirect_to("pod?id=".mysqli_insert_id($connection));
            } else {
                // Failure
                echo 'Failed';
                die("Subject update failed.".mysqli_error($connection));

            }

        }

        $id = '';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query_result = manifest_details($id);
            $data = mysqli_fetch_array($query_result);

            $manifest_id = $data['manifest_no'];
            $manifest_no = get_manifest_no($manifest_id);

            $manifest = mysqli_fetch_array($manifest_no);

            echo '<h2>Details:</h2>';
            echo '<table class="table dataTable default">';
            echo "<tr><th>Date</th><th>Manifest Number</th><th>Waybill Number</th><th>Shipper</th><th>Consignee</th><th>Qty</th><th>Weight</th><th>Type</th><th>Remarks</th></tr>";
            echo '<tr><td>' . $data['date'] . '</td>';
            echo '<td>' . $data['manifest_no'] . '</td>';
            echo '<td>' . $data['waybill_no'] . '</td>';
            echo '<td>' . $data['shipper'] . '</td>';
            echo '<td>' . $data['consignee'] . '</td>';
            echo '<td>' . $data['qty'] . '</td>';
            echo '<td>' . $data['weight'] . '</td>';
            echo '<td>' . $data['type'] . '</td>';
            echo '<td>' . $data['remarks'] . '</td></tr>';
//            echo '<tr><td class="edit"><a href="new_pod.php?id=' . $waybill['id'] . '& shipper=' . $waybill['shipper'] . ' & consignee=' . $waybill['consignee'] . '& service=' . $waybill['type'] . '"><input type="button" value="Create POD"/></a></td></tr>';
            echo '<tr><td class="edit"><button data-toggle="modal" data-target="#createPOD" class="btn btn-success col-xs-12 btn-narrow">Create POD</button></td></tr>';
            echo "</table>";
        }
        else {
            echo '<h2>All Waybills</h2>';
            echo '<table class="table table-striped dataTable waybills">
                    <thead>
                    <tr><th>Waybill_No</th><th>Date</th><th>Manifest_No</th><th>Shipper</th><th>Consignee</th></tr>
                    </thead></table>';
        }
        require 'modals/waybill.modal.php';
        ?>


        </div>
    </div>
</div>
<?php
include "layout/footer.php";
?>
