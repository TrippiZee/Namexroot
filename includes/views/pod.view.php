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
                echo '<td class="edit"><a href="del_pod?id=' .$pod['id'].'" onclick="return confirm(\'Really Delete?\');"><input type="button" class="btn btn-success col-xs-12 btn-narrow" value="Delete"/></a></td>';}
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
