<?php

include "includes/views/layout/header.php";
require 'modals/manifest.modal.php';
require 'modals/dashboard.modal.php';

?>
<div class="col-sm-11 main">
    <div class="row">
        <div class="col-sm-2 col-sm-offset-5">
            <h1 class="dashHeading">Daily Tasks:</h1>
        </div>
    </div>
    <div class="row ">
        <div class="col-sm-6">
            <h1>Manifests for Today(<?= $currentDay; ?>):</h1>
            <table class="table table-striped dataTable default">
                <thead><tr><th>Manifest No</th><th>Driver</th><th>Co Driver</th><th>Registration No</th><th>Finalise</th></tr></thead>
                <tbody>
                        <?php foreach ($date as $manifests){
                            echo '<tr>
                                    <td class="dashboardGetWaybill"><a href="#">'.$manifests->manifest_no.'</a></td>
                                    <td>'.$manifests->driver.'</td>
                                    <td>'.$manifests->co_driver.'</td>
                                    <td>'.$manifests->reg_no.'</td>
                                    <td><a><input type="button" value="Finalise"></a></td>
                                    <td class="manifestId" style="visibility: hidden">'.$manifests->id.'</td>
                                </tr>';
                        } ?>
                </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-3">
                    <button href="#addManifest" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">Add New Manifest</button>
                </div>
            </div>
            <hr>
        </div>
        <div class="col-sm-6">
            <h1>Waybills</h1>
            <table class="table table-striped dataTable default ">
                <thead><tr><th>Waybill No</th><th>Date</th><th>Shipper</th><th>Consignee</th><th>Location</th><th>Create POD</th><th>Delete</th></tr></thead>
                <tbody class="waybillOfSelectedManifest">
                </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <button href="#manifestTracking" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">Update Tracking</button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <button href="#addWaybillDashboard" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">Add New Waybill</button>
                </div>
            </div>
            <hr>
        </div>
    </div>

<?php
include "includes/views/layout/footer.php";
?>
