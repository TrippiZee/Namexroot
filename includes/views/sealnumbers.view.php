<?php
include "layout/header.php";

$manifest_number=$_GET['id'];

$query_result = manifest($manifest_number);
$manifest = mysqli_fetch_array($query_result);



if (isset($_POST['submit'])){
    $seal1 = $_POST['seal1'];
    $seal2 = $_POST['seal2'];
    $seal3 = $_POST['seal3'];
    $seal4 = $_POST['seal4'];

    $query  = "UPDATE manifest SET ";
    $query .= "seal1 = '{$seal1}',";
    $query .= "seal2 = '{$seal2}',";
    $query .= "seal3 = '{$seal3}',";
    $query .= "seal4 = '{$seal4}'";
    $query .= "WHERE id = '{$manifest_number}'";
    $query .= "LIMIT 1";
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
<div id="table">


<form action="#" method="post">
        <table id="table">
            <h2>Enter Seal Numbers where needed</h2>
            <tr><th>Seal1</th><th>Seal2</th><th>Seal3</th><th>Seal4</th></tr>
            <tr><td><input type="text" name="seal1" value="<?php echo htmlentities($manifest['seal1']); ?>" /></td>
                <td><input type="text" name="seal2" value="<?php echo htmlentities($manifest['seal2']); ?>" /></td>
                <td><input type="text" name="seal3" value="<?php echo htmlentities($manifest['seal3']); ?>" /></td>
                <td><input type="text" name="seal4" value="<?php echo htmlentities($manifest['seal4']); ?>" /></td>  </tr>
    <tr> <td><input type="submit" name="submit" value="Submit" /></td>
    </tr>
            <td><input Type="button" VALUE="Cancel" onClick="history.go(-1);return true;"></td>
    </table>

    </form>

    </div>
<?php
include "layout/footer.php";
?>
