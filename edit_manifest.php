<?php
include "header.php";
?>
<?php

$id = '';
if (isset($_POST['submit'])) {

    $number = $_POST['number'];
    $date = $_POST['date'];
    $driver = strtoupper($_POST['driver']);
    $post_id = $_POST['id'];
    $co_driver = strtoupper($_POST['co_driver']);
    $caps_reg_no = strtoupper($_POST['regno']);
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

    $query = manifest($id);
    $manifest = mysqli_fetch_array($query);
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
            <tr><th>Date</th><th>Manifest No</th><th>Driver</th><th>Co-Driver</th><th>Reg No</th></tr>
            <tr><td><input type="date" name="date" value="<?php echo htmlentities($manifest['date']); ?>" /></td>
                <td><input type="text" name="number" value="<?php echo htmlentities($manifest['manifest_no']); ?>" /></td>
                <td><input type="text" name="driver" value="<?php echo htmlentities($manifest['driver']); ?>" /></td>
                <td><input type="text" name="co_driver" value="<?php echo htmlentities($manifest['co_driver']); ?>" /></td>
                <td><input type="text" name="regno" value="<?php echo htmlentities($manifest['reg_no']); ?>" /></td>
                <td><input type="hidden" name="id" value="<?php echo htmlentities($manifest['id']); ?>" /></td></tr>
            <td><input type="submit" name="submit" value="Submit" /></td>
            </tr>
            <td><input Type="button" VALUE="Cancel" onClick="history.go(-1);return true;"></td>

        </table>

    </form>

</div>
</div>

