<?php
include("layout/header.php");

if (isset($_GET['id'])){
    $id=$_GET['id'];
}

$query = "DELETE FROM users WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);
if ($result && mysqli_affected_rows($connection) >= 0) {
    // Success
    redirect_to("user.php");
} else {
    die("Subject update failed.".mysqli_error($connection));

}

?>