<?php

?>
<!----------------------------------------------------------MANIFEST------------------------------------------------------>
<!----------------------------------------------------------NEW MANIFEST------------------------------------------------------>
<div id="addManifest" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Manifest</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control date" name="date" value="">
                        </div>
                        <label for="date" class="col-sm-2 col-form-label">Manifest Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="manifest_no" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shipper" class="col-sm-2 col-form-label">Driver</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="driver" value="">
                        </div>
                        <label for="consignee" class="col-sm-2 col-form-label">Co Driver</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="co_driver" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty" class="col-sm-2 col-form-label">Registration Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="reg_no" value="">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="addManifest" value="Add Manifest" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">
                </div>
            </div>
            </form>

        </div>
    </div>
</div>

<!----------------------------------------------------------EDIT MANIFEST------------------------------------------------------>
<div id="editManifest" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Manifest</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control date" name="date" value="<?php echo htmlentities($manifest['date'])?>">
                        </div>
                        <label for="date" class="col-sm-2 col-form-label">Manifest Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="manifest_no" value="<?php echo htmlentities($manifest['manifest_no'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shipper" class="col-sm-2 col-form-label">Driver</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="driver" value="<?php echo htmlentities($manifest['driver'])?>">
                        </div>
                        <label for="consignee" class="col-sm-2 col-form-label">Co Driver</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="co_driver" value="<?php echo htmlentities($manifest['co_driver'])?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty" class="col-sm-2 col-form-label">Registration Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="reg_no" value="<?php echo htmlentities($manifest['reg_no'])?>">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo htmlentities($manifest['id'])?>">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="editManifest" value="Edit Manifest" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">
                </div>
            </div>
            </form>

        </div>
    </div>
</div>

<!----------------------------------------------------------WAYBILL------------------------------------------------------>
<!----------------------------------------------------------NEW WAYBILL------------------------------------------------------>

<div id="addWaybill" class="modal" role="dialog">
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
                            <select class="fixed-width" name="shipper" >
                                <option selected value=""></option>
                                <?php foreach($customers as $key => $customer){?>
                                    <option value="<?php echo $customer->comp_name;?>" data-pk="<?php echo $customer->id;?>"><?php echo $customer->comp_name;?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <label for="consignee" class="col-sm-2 col-form-label">Consignee</label>
                        <div class="col-sm-4">
                            <select class="fixed-width" name="consignee" >
                                <option selected value=""></option>
                                <?php foreach($customers as $key => $customer){?>
                                    <option value="<?php echo $customer->comp_name;?>" data-pk="<?php echo $customer->id;?>"><?php echo $customer->comp_name;?></option>
                                <?php
                                }
                                ?>
                            </select>
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
                            <input type="hidden" class="form-control" id="manifestId" name="manifestId" value="<?php echo htmlentities($manifest['id'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Area</label>
                        <div class="col-sm-4">
                            <select name="area" >
                                <option selected value=""></option>
                                <?php foreach($areas as $key => $area){?>
                                    <option value="<?php echo $area->area;?>"><?php echo $area->area;?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group row dimensions">
                        <button type="button" class="col-sm-2 addRowButton"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp Add Row</button>
                        <label for="Length" class="col-sm-1 col-form-label">Length</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="length[]" value="">
                        </div>
                        <label for="width" class="col-sm-1 col-form-label">Width</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="width[]" value="">
                        </div>
                        <label for="height" class="col-sm-1 col-form-label">Height</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="height[]" value="">
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

<!----------------------------------------------------------EDIT WAYBILL------------------------------------------------------>
<div id="editWaybill" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Waybill</h4>
            </div>
            <div class="modal-body">
                <form action="waybill" method="post">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Waybill Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control modalWaybillNO" name="number" value="">
                        </div>
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control date modalDate" name="date" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shipper" class="col-sm-2 col-form-label">Shipper</label>
                        <div class="col-sm-4">
                            <select class="fixed-width modalShipper" name="shipper" >
                                <option selected value=""></option>
                                <?php foreach($customers as $key => $customer){?>
                                    <option value="<?php echo $customer->comp_name;?>" data-pk="<?php echo $customer->id;?>"><?php echo $customer->comp_name;?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <label for="consignee" class="col-sm-2 col-form-label">Consignee</label>
                        <div class="col-sm-4">
                            <select class="fixed-width modalConsignee" name="consignee" >
                                <option selected value=""></option>
                                <?php foreach($customers as $key => $customer){?>
                                    <option value="<?php echo $customer->comp_name;?>" data-pk="<?php echo $customer->id;?>"><?php echo $customer->comp_name;?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control modalQty" name="qty" value="">
                        </div>
                        <label for="weight" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control modalWeight" name="weight" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-4">
                            <select name="type" class="modalType">
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
                            <input type="text" class="form-control modalRemarks" name="remarks" value="">
                            <input type="hidden" class="form-control modalId" id="waybillId" name="waybillId" value="">
                            <input type="hidden" class="form-control" id="manifestId" name="manifestId" value="<?php echo htmlentities($manifest['id'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Area</label>
                        <div class="col-sm-4">
                            <select name="area" class="modalArea">
                                <option selected value=""></option>
                                <?php foreach($areas as $key => $area){?>
                                    <option value="<?php echo $area->area;?>"><?php echo $area->area;?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <hr>
<!--                    <div class="form-group row dimensions">-->
<!--                        <button type="button" class="col-sm-2 addRowButton"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp Add Row</button>-->
<!--                        <label for="Lenght" class="col-sm-1 col-form-label">Length</label>-->
<!--                        <div class="col-sm-2">-->
<!--                            <input type="text" class="form-control" name="length[]" value="">-->
<!--                        </div>-->
<!--                        <label for="width" class="col-sm-1 col-form-label">Width</label>-->
<!--                        <div class="col-sm-2">-->
<!--                            <input type="text" class="form-control" name="width[]" value="">-->
<!--                        </div>-->
<!--                        <label for="height" class="col-sm-1 col-form-label">Height</label>-->
<!--                        <div class="col-sm-2">-->
<!--                            <input type="text" class="form-control" name="height[]" value="">-->
<!--                        </div>-->
<!--                    </div>-->

            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="editWaybill" value="Edit Waybill" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>

<!----------------------------------------------------------POD------------------------------------------------------>
<!----------------------------------------------------------CREATE POD------------------------------------------------------>
<div id="createPOD" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create POD</h4>
            </div>
            <div class="modal-body">
                <form action="waybill" method="post">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">POD Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control modalWaybillNO" name="number" value="">
                        </div>
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control date modalDate" name="date" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shipper" class="col-sm-2 col-form-label">Shipper</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control modalShipper" name="shipper" value="" readonly>
                        </div>
                        <label for="consignee" class="col-sm-2 col-form-label">Consignee</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control modalConsignee" name="consignee" value="" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control modalQty" name="qty" value="">
                        </div>
                        <label for="weight" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control modalWeight" name="weight" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-4">
                            <select name="type" class="modalType">
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
                            <input type="text" class="form-control modalRemarks" name="remarks" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deldate" class="col-sm-2 col-form-label">Delivery Date</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control date" name="deldate" value="">
                        </div>
                        <label for="signed" class="col-sm-2 col-form-label">Signed</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="signed" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="time" class="col-sm-2 col-form-label">Time</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control time" name="time" value="">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="createPOD" value="Create POD" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>

<!----------------------------------------------------------ADD SEAL NUMBERS----------------------------------------------------->
<div id="addSealNumbers" class="modal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enter Seal Numbers</h4>
            </div>
            <div class="modal-body">
                <form action="sealNumbers" method="post">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Seal 1</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="seal1" value="">
                        </div>
                        <label for="date" class="col-sm-2 col-form-label">Seal 2</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="seal2" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shipper" class="col-sm-2 col-form-label">Seal 3</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="seal3" value="" >
                        </div>
                        <label for="consignee" class="col-sm-2 col-form-label">Seal 4</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="seal4" value="" >
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo htmlentities($manifest['id'])?>">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="addSealNumbers" value="Add" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>
