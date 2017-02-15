<?php
include "header.php";
?>
<?php

$id = '';
if (isset($_POST['submit'])) {

    $number = $_POST['number'];
    $shipper = strtoupper($_POST['shipper']);
    $consignee = strtoupper($_POST['consignee']);
    $post_id = $_POST['id'];
    $qty = $_POST['qty'];
    $type = strtoupper($_POST['type']);
    $remarks = strtoupper($_POST['remarks']);
    $weight = $_POST['weight'];
    $mid = $_POST['mid'];

    $update_query  = "UPDATE manifest_details SET ";
    $update_query .= "waybill_no = '{$number}', ";
    $update_query .= "shipper = '{$shipper}', ";
    $update_query .= "consignee = '{$consignee}', ";
    $update_query .= "qty = '{$qty}', ";
    $update_query .= "remarks = '{$remarks}', ";
    $update_query .= "weight = '{$weight}', ";
    $update_query .= "type = '{$type}' ";
    $update_query .= "WHERE id = '{$post_id}' ";
    $update_query .= "LIMIT 1";
    $result = mysqli_query($connection,$update_query);
    if ($result && mysqli_affected_rows($connection) >= 0) {
        // Success
        redirect_to("manifest.php?id=".$mid);
    } else {
        die("Subject update failed.".mysqli_error($connection));

    }
}
if (isset($_GET['id'])){
    $id=$_GET['id'];
    $getship=$_GET['shipper'];
    $service=$_GET['type'];

    $query_result = manifest_details($id);
    $waybill = mysqli_fetch_array($query_result);
    $customer_full = customer_full();
    $customer_full1 = customer_full();
    $services = services();

}
?>
<div id="wrapper">
<div id="searchbox">
    <form id="search" name="search">
        <h2>Update Relevant Fields:</h2>
</div>
</form>
<div id="table">

    <form action="#" method="post">
        <table id="table">
            <tr><th>Waybill Number</th><th>Shipper</th><th>Consignee</th><th>Qty</th></tr>
            <tr><td><input type="text" name="number" value="<?php echo htmlentities($waybill['waybill_no']); ?>" /></td>
                <td><?php echo '<select name="shipper" >';
                    echo '<option value="'.$getship.'">'.$getship.'</option>';
                    while ($shipper_option = mysqli_fetch_array($customer_full)) {
                        echo '<option value="'.$shipper_option['comp_name'].'">'.$shipper_option['comp_name'].'</option>';
                    }
                    echo '</select>';
                    echo '</td>' ?>
                <td><input type="text" name="consignee" value="<?php echo htmlentities($waybill['consignee']); ?>" /></td>
                <td><input type="text" name="qty" value="<?php echo htmlentities($waybill['qty']); ?>" /></td></tr>
            <tr><th>Weight</th><th>Type</th><th>Remarks</th></tr>
            <tr>  <td><input type="text" name="weight" value="<?php echo htmlentities($waybill['weight']); ?>" /></td>
                <td><?php echo '<select name="type" >';
                    echo '<option value="'.$service.'">'.$service.'</option>';
                    while ($type = mysqli_fetch_array($services)) {
                        echo '<option value="'.$type['type'].'">'.$type['type'].'</option>';
                    }
                    echo '</select>';
                    echo '</td>' ?>
                <td><input type="text" name="remarks" value="<?php echo htmlentities($waybill['remarks']); ?>" /></td>
                <td><input type="hidden" name="id" value="<?php echo htmlentities($waybill['id']); ?>" /></td>
            <td><input type="hidden" name="mid" value="<?php echo htmlentities($waybill['manifest_no']); ?>" /></td></tr>

            <tr>
                <td><input type="submit" name="submit" value="Submit" /></td>
            </tr>
            <td><input Type="button" VALUE="Cancel" onClick="history.go(-1);return true;"></td>

        </table>

    </form>
</div>

</div>

