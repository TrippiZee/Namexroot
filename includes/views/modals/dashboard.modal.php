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
                            <input type="hidden" class="form-control maniNo" id="manifestId" name="manifestId" value="">
                        </div>
                    </div>

                    <hr>
                    <div class="form-group row dimensions">
                        <button type="button" class="col-sm-2 addRowButton"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp Add Row</button>
                        <label for="Lenght" class="col-sm-1 col-form-label">Length</label>
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
                    <input type="submit" name="createWaybillDash" value="Create Waybill" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>
<!----------------------------------------------------------EDIT WAYBILL------------------------------------------------------>

<div id="editWaybillDashboard" class="modal" role="dialog">
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
                    <input type="submit" name="editWaybillDash" value="Edit Waybill" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>
<!----------------------------------------------------------PRINT INVOICE------------------------------------------------------>

<div id="printInvoice" class="modal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Print Invoice</h4>
            </div>
            <div class="modal-body">
                <form TARGET="_blank" action="print_invoice" method="post">

                    <div class="form-group row">
                        <label for="type" class="col-sm-5 col-form-label">Select Debtor</label>
                        <div class="col-sm-5">
                            <select name="debtor" class="modalSelectPayee fixed-width">
                                <option selected value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-5 col-form-label">Number of docs</label>
                        <div class="col-sm-2">
                            <input type="number" min="0" name="docCount" class="fixed-width">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-5 col-form-label">Outlying area?</label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="outlyingCheckbox">
                        </div>
                        <div class="col-sm-2" id="outlyingInput">
                            <input type="text" name="outlying" class="fixed-width">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-5 col-form-label">Saturday Deliveries?</label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="saturdayCheckbox">
                        </div>
                        <div class="col-sm-2" id="saturdayInput">
                            <input type="text" name="saturday" class="fixed-width">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-5 col-form-label">VAT & Disbursement?</label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="vatCheckbox">
                        </div>
                        <div class="col-sm-2" id="vatInput">
                            <input type="text" name="vat" class="fixed-width">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-5 col-form-label">Insurance?</label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="insuranceCheckbox">
                        </div>
                        <div class="col-sm-2" id="insuranceInput">
                            <input type="text" name="insurance" class="fixed-width">
                        </div>
                    </div>
                    <input type="hidden" class="form-control modalInvoiceId" name="waybillId" value="">

            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="printInvoice" value="GO" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>
<!----------------------------------------------------------UPDATE LOCATION------------------------------------------------------>

<div id="updateLocation" class="modal" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Location</h4>
            </div>
            <div class="modal-body">
                <form action="updateLocation" method="post">

                    <div class="form-group row">
                        <label for="location" class="col-sm-5 col-form-label">Location</label>
                        <div class="col-sm-7">
                                <input type="text" class="form-control modalLocation" name="location" value="">
                                <input type="hidden" class="form-control modalLocationId" name="id" value="">
                        </div>
                    </div>

            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="updateLocation" value="Update" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>
