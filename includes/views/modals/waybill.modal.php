<?php

?>
<!---------------------------------------------------------CREATE POD------------------------------------------------------------>

<div id="createPOD" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create POD</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">POD Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="number" value="<?php echo htmlentities($data['waybill_no'])?>">
                        </div>
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control date" name="date" value="<?php echo htmlentities($data['date'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shipper" class="col-sm-2 col-form-label">Shipper</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="shipper" value="<?php echo htmlentities($data['shipper'])?>">
                        </div>
                        <label for="consignee" class="col-sm-2 col-form-label">Consignee</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="consignee" value="<?php echo htmlentities($data['consignee'])?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="qty" value="<?php echo htmlentities($data['qty'])?>">
                        </div>
                        <label for="weight" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="weight" value="<?php echo htmlentities($data['weight'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-4">
                            <select name="type">
                                <option selected value="<?php echo htmlentities($data['type'])?>"><?php echo htmlentities($data['type'])?></option>
                                <?php foreach($services as $key => $service){?>
                                    <option value="<?php echo $service->type;?>"><?php echo $service->type;?></option>
                                    <?php
                                }
                                ?>
                            </select>

                            <!--                            <input type="text" class="form-control" name="type" value="--><?php //echo htmlentities($data['type'])?><!--">-->
                        </div>
                        <label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="remarks" value="<?php echo htmlentities($data['remarks'])?>">
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
