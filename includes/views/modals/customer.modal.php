<?php

?>
<!-- ----------------------------Customer------------------------------------------- -->
<div id="addCustomer" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Customer</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Company Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="name" name="name" required="required">
                        </div>
                        <label for="acc_no" class="col-sm-2 col-form-label">Account Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="acc_no" name="acc_no">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address1" class="col-sm-2 col-form-label">Address1</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="address1" name="address1">
                        </div>
                        <label for="address2" class="col-sm-2 col-form-label">Address2</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="address2" name="address2">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                        <label for="country" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="country" name="country">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="codet" class="col-sm-2 col-form-label">Tel Code</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="codet" name="codet">
                        </div>
                        <label for="telno" class="col-sm-2 col-form-label">Tel Number</label>
                        <div class="col-sm-4">
                            <input type="tel" class="form-control" id="telno" name="telno">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="codef" class="col-sm-2 col-form-label">Fax Code</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="codef" name="codef">
                        </div>
                        <label for="faxno" class="col-sm-2 col-form-label">Fax Number</label>
                        <div class="col-sm-4">
                            <input type="tel" class="form-control" id="faxno" name="faxno">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vat" class="col-sm-2 col-form-label">VAT number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="vat" name="vat">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="add" value="Add" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>

<div id="editCustomer" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Customer</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Company Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlentities($customer['comp_name'])?>">
                        </div>
                        <label for="acc_no" class="col-sm-2 col-form-label">Account Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="acc_no" name="acc_no" value="<?php echo htmlentities($customer['acc_no'])?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address1" class="col-sm-2 col-form-label">Address1</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="address1" name="address1" value="<?php echo htmlentities($customer['address1'])?>">
                        </div>
                        <label for="address2" class="col-sm-2 col-form-label">Address2</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="address2" name="address2" value="<?php echo htmlentities($customer['address2'])?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlentities($customer['city'])?>">
                        </div>
                        <label for="country" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="country" name="country" value="<?php echo htmlentities($customer['country'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="codet" class="col-sm-2 col-form-label">Tel Code</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="codet" name="codet" value="<?php echo htmlentities($customer['codet'])?>">
                        </div>
                        <label for="telno" class="col-sm-2 col-form-label">Tel Number</label>
                        <div class="col-sm-4">
                            <input type="tel" class="form-control" id="telno" name="telno" value="<?php echo htmlentities($customer['tel'])?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="codef" class="col-sm-2 col-form-label">Fax Code</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="codef" name="codef" value="<?php echo htmlentities($customer['codef'])?>">
                        </div>
                        <label for="faxno" class="col-sm-2 col-form-label">Fax Number</label>
                        <div class="col-sm-4">
                            <input type="tel" class="form-control" id="faxno" name="faxno" value="<?php echo htmlentities($customer['fax'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vat" class="col-sm-2 col-form-label">VAT number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="vat" name="vat" value="<?php echo htmlentities($customer['vat'])?>">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo htmlentities($customer['id'])?>">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="edit" value="Edit" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>

<!-- -----------------------------Rates--------------------------------------------- -->

<div id="addRates" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add/Edit Rates</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post">

                    <div class="form-group row">
                        <label for="docFee" class="col-sm-2 col-form-label">Documentation Fee</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="docFee" name="docFee" value="<?php echo htmlentities($sundries['documentation_fee'])?>">
                        </div>
                        <label for="fuel" class="col-sm-2 col-form-label">Fuel Surcharge</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="fuel" name="fuel" value="<?php echo htmlentities($sundries['fuel_surcharge'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="saturday" class="col-sm-2 col-form-label">Saturday Deliveries</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="saturday" name="saturday" value="<?php echo htmlentities($sundries['saturday_deliveries'])?>">
                        </div>
                        <label for="windhoek" class="col-sm-2 col-form-label">Freight Windhoek</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="windhoek" name="windhoek" value="<?php echo htmlentities($sundries['freight_windhoek'])?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="namibia" class="col-sm-2 col-form-label">Freight Namibia</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="namibia" name="namibia" value="<?php echo htmlentities($sundries['freight_namibia'])?>">
                        </div>
                        <label for="outlying" class="col-sm-2 col-form-label">Outlying Areas</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="outlying" name="outlying" value="<?php echo htmlentities($sundries['outlying_areas'])?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <input type="hidden" class="form-control" id="acc_no" name="acc_no" value="<?php echo htmlentities($customer['acc_no'])?>">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo htmlentities($customer['id'])?>">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <div class="form-group row">
                    <input type="submit" name="addRates" value="Add" />
                    <input Type="button" VALUE="Cancel" data-dismiss="modal">

                </div>
            </div>
            </form>

        </div>
    </div>
</div>
