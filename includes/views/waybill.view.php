<?php
include "layout/header.php";
?>
<div class="col-sm-11 main">
    <div class="row">
        <div class="col-sm-12">
        <?php

        $id = '';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query_result = manifest_details($id);
            $data = mysqli_fetch_array($query_result);

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
        require 'modals/manifest.modal.php';
        ?>


        </div>
    </div>
</div>
<?php
include "layout/footer.php";
?>
