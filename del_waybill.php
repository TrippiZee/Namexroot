<?php
include("layout/header.php");

if (isset($_GET['id'])){
    $id=$_GET['id'];
    $query_result = manifest_details($id);
    $waybill = mysqli_fetch_array($query_result);
    $manifest_id = $waybill['manifest_no'];
}

$query = "DELETE FROM manifest_details WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);
if ($result && mysqli_affected_rows($connection) >= 0) {
    // Success
    redirect_to("manifest.php?id=".$manifest_id);
} else {
    die("Subject update failed.".mysqli_error($connection));

}

?>
