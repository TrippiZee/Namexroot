<?php ?>
<!----------------------------------------------------------NEW WAYBILL------------------------------------------------------>

<div id="addWaybillDashboard" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create New Waybill</h4>
            </div>
            <div class="modal-body">
                <form action="waybill" method="post">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Waybill Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="number" value="">
                        </div>
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control date" name="date" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shipper" class="col-sm-2 col-form-label">Shipper</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="shipper" value="">
                        </div>
                        <label for="consignee" class="col-sm-2 col-form-label">Consignee</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="consignee" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="qty" value="">
                        </div>
                        <label for="weight" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="weight" value="">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-4">
                            <select name="type" >
                                <option selected value=""></option>
                                <?php foreach($services as $key => $service){?>
    <option value="<?php echo $service->type;?>"><?php echo $service->type;?></option>
    <?php
}
                                ?>
</select>
</div>
<label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
<div class="col-sm-4">
    <input type="text" class="form-control" name="remarks" value="">
    <input type="hidden" class="form-control" id="manifestId" name="manifestId" value="<?php echo htmlentities($manifests->id)?>">
</div>
</div>

<div class="form-group row">
    <label for="dimensions" class="col-sm-2 col-form-label">Number of Parcels</label>
    <div class="col-sm-4">
        <select name="dimensions">
            <?php
            for($i = 0;$i <= 100; $i++){
                echo "<option value=".$i.">$i</option>";
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group row" id="dimensions">
    <label for="Lenght" class="col-sm-1 col-form-label">Length</label>
    <div class="col-sm-3">
        <input type="text" class="form-control date" name="length" value="">
    </div>
    <label for="width" class="col-sm-1 col-form-label">Width</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" name="width" value="">
    </div>
    <label for="height" class="col-sm-1 col-form-label">Height</label>
    <div class="col-sm-3">
        <input type="text" class="form-control time" name="height" value="">
    </div>
</div>
</div>

<div class="modal-footer">
    <div class="form-group row">
        <input type="submit" name="createWaybill" value="Create Waybill" />
        <input Type="button" VALUE="Cancel" data-dismiss="modal">

    </div>
</div>
</form>

</div>
</div>
</div>
