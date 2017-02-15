<?php
include "header.php";
?>
<?php
$id = '';
if (isset($_POST['submit'])) {

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
        redirect_to("pod.php?id=".$post_id);
    } else {
        die("Subject update failed.".mysqli_error($connection));

    }
}
if (isset($_GET['id'])){
    $id=$_GET['id'];
    $getship = $_GET['shipper'];
    $getconsignee = $_GET['consignee'];

}
$edit = pod($id);

$edit_row = mysqli_fetch_array($edit);
$customer_full = customer_full();
$customer_full1 = customer_full();
$services = services();


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
        <tr>
            <th>POD Number</th><th>Date</th><th>Shipper</th><th>Consignee</th><th>Qty</th>
        </tr>
        <tr>
            <td><input type="text" name="number" value="<?php echo htmlentities($edit_row['pod_no']); ?>" /></td>
            <td><input type="date" name="date" value="<?php echo htmlentities($edit_row['date']); ?>" required="required" /></td>
            <td><input type="text" name="shipper" value="<?php echo htmlentities($edit_row['shipper']); ?>" /></td>
            <td><input type="text" name="consignee" value="<?php echo htmlentities($edit_row['consignee']); ?>" /></td>
            <td><input type="text" name="qty" value="<?php echo htmlentities($edit_row['qty']); ?>" /></td>
        </tr>
        <tr>
            <th>Weight</th><th>Type</th><th>Remarks</th><th>Delivery Date</th><th>Signed By</th><th>Time</th>
        </tr>
        <tr>
            <td><input type="text" name="weight" value="<?php echo htmlentities($edit_row['weight']); ?>" /></td>
            <td><input type="text" name="type" value="<?php echo htmlentities($edit_row['type']); ?>" /></td>
            <td><input type="text" name="remarks"  value="<?php echo htmlentities($edit_row['remarks']); ?>" /></td>
            <td><input type="date" name="delivery" value="<?php echo htmlentities($edit_row['delivery_date']); ?>" required="required"/></td>
            <td><input type="text" name="signed" value="<?php echo htmlentities($edit_row['signed_by']); ?>" required="required"/></td>
            <td><input type="time" name="time" value="<?php echo htmlentities($edit_row['time']); ?>" required="required" /></td>
            <td><input type="hidden" name="id" value="<?php echo htmlentities($edit_row['id']); ?>" /></td>

        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Submit" /></td>
        </tr>
        <td><input Type="button" VALUE="Cancel" onClick="history.go(-1);return true;"></td>

    </table>

</form>
</div>
    </div>