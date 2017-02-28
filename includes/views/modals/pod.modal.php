<?php

?>
<!---------------------------------------------------------POD------------------------------------------------------------>

<div id="editPOD" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit POD</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">POD Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="number" value="<?php echo htmlentities($pod['pod_no'])?>">
                        </div>
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="date" value="<?php echo htmlentities($pod['date'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shipper" class="col-sm-2 col-form-label">Shipper</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="shipper" value="<?php echo htmlentities($pod['shipper'])?>">
                        </div>
                        <label for="consignee" class="col-sm-2 col-form-label">Consignee</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="consignee" value="<?php echo htmlentities($pod['consignee'])?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="qty" value="<?php echo htmlentities($pod['qty'])?>">
                        </div>
                        <label for="weight" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="weight" value="<?php echo htmlentities($pod['weight'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-4">
                            <select name="type" >
                                <option selected value="<?php echo htmlentities($pod['type'])?>"><?php echo htmlentities($pod['type'])?></option>
                                <?php foreach($services as $key => $service){?>
                                    <option value="<?php echo $service->type;?>"><?php echo $service->type;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="remarks" value="<?php echo htmlentities($pod['remarks'])?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deldate" class="col-sm-2 col-form-label">Delivery Date</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control date" name="delivery" value="<?php echo htmlentities($pod['delivery_date'])?>">
                        </div>
                        <label for="signed" class="col-sm-2 col-form-label">Signed</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="signed" value="<?php echo htmlentities($pod['signed_by'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="time" class="col-sm-2 col-form-label">Time</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control time" name="time" value="<?php echo htmlentities($pod['time'])?>">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo htmlentities($pod['id'])?>">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="editPod" value="Edit" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>
