<?php

include "includes/views/layout/header.php";

?>
    <div class="col-sm-11 main">
        <div class="row">
            <div class="col-sm-2 col-sm-offset-5">
                <h1 class="dashHeading">Quick Actions:</h1>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-5 dashboardTaskList">
                <h1 class="text-center dtlh">Manifest</h1>
                <div class="text-center menubutton">
                    <button data-toggle="modal" data-target="#addManifest" class="btn btn-success">New Manifest</button>
                    <button class="btn btn-success">Search/Edit Manifest</button>
                    <button class="btn btn-success">Finalise Manifest</button>
                </div>
            </div>
            <div class="col-sm-5 dashboardTaskList">
                <h1 class="text-center dtlh">Customer</h1>
                <div class="text-center ">
                    <button data-toggle="modal" data-target="#addCustomer" class="btn btn-success"  >New Customer</button>
                    <button type="button" class="btn btn-success">Search/Edit Customer</button>
                    <button type="button" class="btn btn-success">Update Rates</button>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-5 dashboardTaskList">
                <h1 class="text-center dtlh">Waybill</h1>
                <div class="text-center menubutton">
                    <button class="btn btn-success ">Create POD</button>
                    <button class="btn btn-success ">Print Invoice</button>
                    <button class="btn btn-success">Find Waybill</button>
                </div>
            </div>
            <div class="col-sm-5 dashboardTaskList">
                <h1 class="text-center dtlh">User</h1>
                <div class="text-center menubutton">
                    <button data-toggle="modal" data-target="#addUser" class="btn btn-success">New User</button>
                    <button class="btn btn-success">Search User</button>
                </div>
            </div>
        </div>
    </div>
<?php
include "includes/views/layout/footer.php";
require 'modals/manifest.modal.php';
require 'modals/dashboard.modal.php';
require 'modals/user.modal.php';
include 'modals/customer.modal.php';
//require 'modals/customer.modal.php';

?>