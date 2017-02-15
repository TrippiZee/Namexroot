<?php
include "header.php";
?>
<?php

if (isset($_POST['submit'])) {

    $number = $_POST['number'];
    $date = $_POST['date'];
    $driver = strtoupper($_POST['driver']);
    $co_driver = strtoupper($_POST['co_driver']);
    $caps_reg_no = strtoupper($_POST['regno']);
    $reg_no = trim($caps_reg_no,' ');


    $query  = "INSERT INTO manifest (";
    $query .= "  manifest_no, date, reg_no, driver, co_driver";
    $query .= ") VALUES (";
    $query .= "  '{$number}', '{$date}', '{$reg_no}', '{$driver}', '{$co_driver}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Success
        redirect_to("manifest.php?id=".mysqli_insert_id($connection));
    } else {
        // Failure
        echo 'Failed';
        die("Subject update failed.".mysqli_error($connection));

    }

}

?>

<div id="sidemenu">
    <ul>
        <li><a href="includes/views/manifest.php">Search</a> </li>
        <li><a href="new_manifest.php">Add New</a></li>
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
            <tr><th>Date</th><th>Manifest No</th><th>Driver</th><th>Co-Driver</th><th>Reg No</th></tr>
            <tr><td><input type="date" name="date" value="" required="required"/></td>
                <td><input type="text" name="number" value="" required="required"/></td>
                <td><input type="text" name="driver" value="" required="required"/></td>
                <td><input type="text" name="co_driver" value="" /></td>
                <td><input type="text" name="regno" value="" required="required"/></td></tr>
                <tr><td><input type="submit" name="submit" value="Submit" /></td>
            </tr>
            <td><input Type="button" VALUE="Cancel" onClick="history.go(-1);return true;"></td>

        </table>

    </form>

</div>
</div>