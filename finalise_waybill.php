<?php
require ("includes/core.php");
require ("includes/db_connection.php");

if (isset ($_GET['id'])){
    $id = $_GET['id'];
    $finalised = 1;
    $update_query = "UPDATE manifest SET ";
    $update_query .= "finalised = '{$finalised}' ";
    $update_query .= "WHERE id = '{$id}' ";
    $update_query .= "LIMIT 1";
    $result = mysqli_query($connection,$update_query);

    if ($result && mysqli_affected_rows($connection) >= 0) {
        // Success
        redirect_to("manifest.php?id=".$id);

} else {
        die("Subject update failed.".mysqli_error($connection));
    }

} else {
    echo "Fatal error, Click to go back: <a href='includes/views/manifest.php'><input type='button' value='BACK!'/></a>";
}


?>