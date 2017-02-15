<?php
include "header.php";
?>
<?php
$customer_full = customer_full();
$customer_full1 = customer_full();
$services = services();
$manifest_number=$_GET['id'];

if (isset($_POST['submit'])) {


    $date = $_POST['date'];
    $number = $_POST['number'];
    $shipper = strtoupper($_POST['shipper']);
    $consignee = strtoupper($_POST['consignee']);
    $qty = $_POST['qty'];
    $type = strtoupper($_POST['type']);
    $remarks = strtoupper($_POST['remarks']);
    $weight = $_POST['weight'];


    $query  = "INSERT INTO manifest_details (";
    $query .= "  date, manifest_no, waybill_no, shipper, consignee, qty, weight, type, remarks";
    $query .= ") VALUES (";
    $query .= " '{$date}', '{$manifest_number}', '{$number}', '{$shipper}', '{$consignee}', '{$qty}', '{$weight}', '{$type}', '{$remarks}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Success
        redirect_to("manifest.php?id=".$manifest_number);
    } else {
        // Failure
        echo 'Failed';
        die("Subject update failed.".mysqli_error($connection));

    }

}

?>

<div id="sidemenu">
    <ul>
        <li><a href="includes/views/waybill.php">Search</a> </li>
        <li><a href="new_waybill.php">Add New</a></li>
        <li><a href="#">View All</a></li>

    </ul>
</div>
<div id="wrapper">
<div id="searchbox">
    <form id="search" name="search">
        <h2>Enter New Information:</h2>
</div>
</form>
<div id="table">
    <form action="#" method="post">
        <table id="table">
            <tr><th>Date</th><th>Waybill Number</th><th>Shipper</th><th>Consignee</th></tr>
            <tr><td><input type="date" name="date" value="" REQUIRED="required"/></td>
                <td><input type="text" name="number" value="" required="required"/></td>
                <td><?php echo '<select name="shipper" >';
                    while ($shipper_option = mysqli_fetch_array($customer_full)) {
                        echo '<option value="'.$shipper_option['comp_name'].'">'.$shipper_option['comp_name'].'</option>';
                    }
                    echo '</select>';
                    echo '</td>' ?>
                <td><input type="text" name="consignee" value="" required="required"/></td></tr>
            <tr><th>Qty</th><th>Weight</th><th>Type</th><th>Remarks</th></tr>
            <tr> <td><input type="text" name="qty" value="" required="required"/></td>
                <td><input type="text" name="weight" value="" required="required"/></td>
                <td><?php echo '<select name="type" >';
                    while ($type = mysqli_fetch_array($services)) {
                        echo '<option value="'.$type['type'].'">'.$type['type'].'</option>';
                    }
                    echo '</select>';
                    echo '</td>' ?>
                <td><input type="text" name="remarks" value="" /></td>
            <tr> <td><input type="submit" name="submit" value="Submit" /></td>
            </tr>
            <td><input Type="button" VALUE="Cancel" onClick="history.go(-1);return true;"></td>

        </table>

    </form>
</div>
</div>