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
    <hr>
    <div class="row ">
        <div class="col-sm-5">
            <h1>Manifests for Today(<?= $currentDay; ?>):</h1>
            <table class="table table-striped dataTable default">
                <thead><tr><th>Manifest No</th><th>Driver</th><th>Registation</th><th>Detail</th><th>Finalise</th><th>Print</th></tr></thead>
                <tbody>
                        <?php foreach ($date as $manifests){
                            echo '<tr>
                                    <td class="dashboardGetWaybill"><a href="#">'.$manifests->manifest_no.'</a></td>
                                    <td>'.$manifests->driver.'</td>
                                    <td>'.$manifests->reg_no.'</td>
                                    <td><a href="manifest?id='.$manifests->id.'"><input type="button" value="Details"></a></td>
                                    <td><a><input type="button" class="finalise" value="Finalise"></a></td>
                                    <td><a href="print_manifest?print_id='.$manifests->id.'" target="_BLANK"><input type="button" value="Print Manifest"></a></td>
                                    <td class="manifestId" style="display:none">'.$manifests->id.'</td>
                                    <td class="finaliseParam" style="display:none">'.$manifests->finalised.'</td>
                                </tr>';
                        } ?>
                </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-3">
                    <button href="#addManifest" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow" >Add New Manifest</button>
                </div>
            </div>
            <hr>
        </div>
        <div class="col-sm-7">
            <h1>Waybills</h1>
            <table class="table table-striped dataTable default initialiseInjectedHTML">
                <thead><tr><th>Waybill No</th><th>Date</th><th>Shipper</th><th>Consignee</th><th colspan="2">Location</th><th>Create POD</th><th>Print Invoice</th></tr></thead>
                <tbody class="waybillOfSelectedManifest">
                </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <button href="#addWaybillDashboard" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow addWaybillDashboard">Add New Waybill</button>
                </div>
            </div>
            <hr>
        </div>
    </div>

<?php
include "includes/views/layout/footer.php";
?>
