<?php

include "includes/views/layout/header.php";
?>
<div class="col-sm-11 main">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <h1 class="dashHeading">Namibia Express Daily Tasks:</h1>
        </div>
    </div>
    <div class="row ">
        <div class="col-sm-6 db-top-left">
            <h1>Manifests:</h1>
            <table class="table table-striped dataTable default">
                <thead><tr><th>Manifest NO</th></tr></thead>
                <tbody>
                        <?php foreach ($date as $manifests){
                            echo "<tr><td>".$manifests->manifest_no."</td></tr>";
                        } ?>
                </tbody>
            </table>
            <button href="#addNewCustomer" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">Add New Customer</button>
            <br/>
            <button href="#addNewCustomer" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">View/Edit Customers</button>
        </div>
        <div class="col-sm-6 db-top-right">
            <h1>Manifest</h1>
            <button href="#addNewCustomer" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">Add New Manifest</button>
            <br>
            <button href="#addNewCustomer" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">View/Edit Manifest</button>
        </div>
    </div>

    <div class="row db-bottom">
        <div class="col-sm-6 db-bottom-left">
            <h1>Tracking</h1>
            <button href="#addNewCustomer" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">Update Tracking Info</button>
            <br>
            <button href="#addNewCustomer" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">Track shipment</button>
        </div>
        <div class="col-sm-6 db-bottom-right">
            <h1>POD</h1>
            <button href="#addNewCustomer" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">Add New POD</button>
            <br>
            <button href="#addNewCustomer" data-toggle="modal"  class="btn btn-success col-xs-12 btn-narrow">View all POD</button>
        </div>
    </div>
</div>

<?php
include "includes/views/layout/footer.php";
?>
