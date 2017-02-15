<?php
include "layout/header.php";
?>
<div class="col-sm-11 main">
    <div class="row">
        <div class="col-sm-2 col-sm-offset-5">
            <h2>All POD:</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

        <?php

        if (isset($_POST['editPod'])) {

            $pod_no = $_POST['number'];
            $date = $_POST['date'];
            $shipper = strtoupper($_POST['shipper']);
            $consignee = strtoupper($_POST['consignee']);
            $qty = strtoupper($_POST['qty']);
            $weight = $_POST['weight'];
            $type = strtoupper($_POST['type']);
            $remarks = strtoupper($_POST['remarks']);
            $delivery = $_POST['delivery'];
            $signed = strtoupper($_POST['signed']);
            $time = $_POST['time'];
            $post_id = $_POST['id'];


            $update_query  = "UPDATE pod SET ";
            $update_query .= "pod_no = '{$pod_no}', ";
            $update_query .= "date = '{$date}', ";
            $update_query .= "shipper = '{$shipper}', ";
            $update_query .= "consignee = '{$consignee}', ";
            $update_query .= "qty = '{$qty}', ";
            $update_query .= "weight = '{$weight}', ";
            $update_query .= "type = '{$type}', ";
            $update_query .= "remarks = '{$remarks}', ";
            $update_query .= "delivery_date = '{$delivery}', ";
            $update_query .= "signed_by = '{$signed}', ";
            $update_query .= "time = '{$time}' ";
            $update_query .= "WHERE id = '{$post_id}' ";
            $update_query .= "LIMIT 1";
            $result = mysqli_query($connection,$update_query);
            if ($result && mysqli_affected_rows($connection) >= 0) {
                // Success
                redirect_to("pod?id=".$post_id);
            } else {
                die("Subject update failed.".mysqli_error($connection));

            }
        }

        $id = '';
        if (isset($_GET['id'])){
            $id=$_GET['id'];

            $query_result = pod($id);
            $pod = mysqli_fetch_array($query_result);

            echo '<h2>Details:</h2>';
            echo '<table class="table dataTable default">';
            echo "<tr><th>POD Number</th><th>Date</th><th>Shipper</th><th>Consignee</th><th>Qty</th><th>Weight</th><th>Type</th><th>Remarks</th><th>Delivery Date</th><th>Signed By</th><th>Time</th></tr>";
            echo '<tr><td>'. $pod['pod_no']. '</td>';
            echo '<td>'.$pod['date'].'</td>';
            echo '<td>'.$pod['shipper'].'</td>';
            echo '<td>'.$pod['consignee'].'</td>';
            echo '<td>'.$pod['qty'].'</td>';
            echo '<td>'.$pod['weight'].'</td>';
            echo '<td>'.$pod['type'].'</td>';
            echo '<td>'.$pod['remarks'].'</td>';
            echo '<td>'.$pod['delivery_date'].'</td>';
            echo '<td>'.$pod['signed_by'].'</td>';
            echo '<td>'.$pod['time'].'</td></tr>';
            echo '<tr><td class="edit"><button data-toggle="modal" data-target="#editPOD" class="btn btn-success col-xs-12 btn-narrow">Edit POD</button></td>';
//            echo '<tr><td class="edit"><a href="../../edit_pod.php?id=' .$pod['id'].'&consignee='.$pod['consignee'].'&shipper='.$pod['shipper'].'"><input type="button" value="Edit"/></a></td>';
            if (getuserfield('role') == 'admin'){
                echo '<td class="edit"><a href="del_pod.php?id=' .$pod['id'].'" onclick="return confirm(\'Really Delete?\');"><input type="button" value="Delete"/></a></td>';}
            echo "</tr>";
            echo "</table>";
        }
        else {
            echo '<table class="table table-striped dataTable pods">
                    <thead>
                    <tr><th>POD Number</th><th>Date</th><th>Shipper</th><th>Consignee</th></tr>
                    </thead></table>';
        }
        require 'modals/pod.modal.php';

        ?>
        </div>
    </div>
</div>
<?php
include "layout/footer.php";
?>
