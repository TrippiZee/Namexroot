<?php

include "includes/views/layout/header.php";
require 'modals/manifest.modal.php';

?>
<div class="col-sm-11 main">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <h1 class="dashHeading">Namibia Express Daily Tasks:</h1>
        </div>
    </div>
    <div class="row ">
        <div class="col-sm-6 db-top-left">
            <h1>Manifests for Today(<?= $currentDay; ?>):</h1>
            <table class="table table-striped dataTable default">
                <thead><tr><th>Manifest No</th><th>Driver</th><th>Registration No</th><th>Location</th><th>Finalise</th></tr></thead>
                <tbody>
                        <?php foreach ($date as $manifests){
                            echo "<tr>
                                    <td><a href='manifest?id=".$manifests->id."'>".$manifests->manifest_no."</a></td>
                                    <td>".$manifests->driver."</td>
                                    <td>".$manifests->reg_no."</td>
                                    <td>
                                    <select name='location'>
                                        <option value='JHB'>JHB</option>
                                        <option value='UPINGTON'>UPINGTON</option>
                                        <option value='BORDER'>BORDER</option>
                                        <option value='WINDHOEK'>WINDHOEK</option>
                                    </select>
                                    </td>
                                    <td><a><input type='button' value='Finalise'></a></td>
                                </tr>";
                        } ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <button href="#addManifest" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">Add New Manifest</button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <button href="#manifestTracking" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">Update Tracking</button>
                </div>
            </div>
            <hr>
        </div>
        <div class="col-sm-6 db-top-right">
            <h1>Manifest</h1>
            <button href="#addNewCustomer" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">Add New Manifest</button>
            <br>
            <button href="#addNewCustomer" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">View/Edit Manifest</button>
        </div>
    </div>

</div>

<?php
include "includes/views/layout/footer.php";
?>
