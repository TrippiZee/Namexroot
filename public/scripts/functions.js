$(document).ready(function() {

    $("#dimensions").hide();
    $("#outlyingInput").hide();
    $("#saturdayInput").hide();
    $("#vatInput").hide();
    $("#insuranceInput").hide();


    $(".customers").dataTable({
        "processing": true,
        "serverSide":true,
        "ajax":{
            //url:"includes/controllers/customers.php",
            url:"ajaxCustomer",
            type:"post"
        }
    });
    $(".manifests").dataTable({
        "processing": true,
        "serverSide":true,
        "ajax":{
            //url:"includes/controllers/manifests.php",
            url:"ajaxManifest",
            type:"post"
        },
        "aaSorting": [ [0,'desc'] ]
    });
    $(".waybills").dataTable({
        "processing": true,
        "serverSide":true,
        "ajax":{
            //url:"includes/controllers/waybills.php",
            url:"ajaxWaybills",
            type:"post"
        },
        "aaSorting": [ [0,'desc'] ]
    });
    $(".pods").dataTable({
        "processing": true,
        "serverSide":true,
        "ajax":{
            //url:"includes/controllers/pods.php",
            url:"ajaxPods",
            type:"post"
        },
        "aaSorting": [ [0,'desc'] ]
    });
    $(".users").dataTable({
        "processing": true,
        "serverSide":true,
        "ajax":{
            url:"ajaxUsers",
            type:"post"
        }
    });
    $(".date").datepicker({
        dateFormat:"yy-mm-dd"
    });
    $(".time").timepicker();

    $(".addWaybillDashboard").hide();

    $(".getRowText").click(function () {
        getRowData($(this));
    });

    function getRowData(element){
        var waybillNo = element.closest('tr').find('td.waybillNo').text();
        var shipper = element.closest('tr').find('td.shipper').text();
        var consignee = element.closest('tr').find('td.consignee').text();
        var qty = element.closest('tr').find('td.qty').text();
        var weight = element.closest('tr').find('td.weight').text();
        var type = element.closest('tr').find('td.type').text();
        var remarks = element.closest('tr').find('td.remarks').text();
        var date = element.closest('tr').find('td.date').text();
        var area = element.closest('tr').find('td.area').text();
        var id = element.closest('tr').find('td.id').text();
        //var manifestId = element.closest('tr').find('td.manifestId').text();
        $(".modalWaybillNO").val(waybillNo);
        $(".modalShipper").val(shipper);
        $(".modalConsignee").val(consignee);
        $(".modalQty").val(qty);
        $(".modalWeight").val(weight);
        $(".modalType").val(type);
        $(".modalRemarks").val(remarks);
        $(".modalDate").val(date);
        $(".modalArea").val(area);
        $(".modalId").val(id);
        //$(".modalmanifestId").val(manifestId);
    }

    $(".dashboardGetWaybill").click(function(){
        $(".addWaybillDashboard").show();
        var manifestId = $(this).closest('tr').find('td.manifestId').text();
        var finalised = $(this).closest('tr').find('td.finaliseParam').text();
        console.log("finalised = "+finalised);

        $(".maniNo").val(manifestId);
        $.ajax({
            url:'dashboardManifestWaybills',
            type:'get',
            data:{
                manifestId: manifestId
            },
            success: function(response){
                var subcat = $('.waybillOfSelectedManifest');
                var data = JSON.parse(response);
                subcat.empty();
                if (data.length == 0){
                    subcat.append("<tr><td></td><td></td><td></td><td colspan='5'><h4>NO WAYBILLS EXIST - CREATE A NEW ONE?</h4></td></tr>");
                }else{
                    $.each(data, function(index,element) {
                        subcat.append("<tr><td class='waybillNo getRowTextDash'><a href='#' data-toggle='modal' data-target='#editWaybillDashboard' data-waybillNo='element.waybill_no'>" + element.waybill_no + "</a></td>" +
                            "<td class='date'>" + element.date + "</td>" +
                            "<td class='shipper'>" + element.shipper + "</td>" +
                            "<td class='consignee'>" + element.consignee + "</td>" +
                            //"<td><a href='#' class='location' data-type='text' data-title='Input Location' data-value='element.location' data-pk='element.id'>" + element.location + "</a></td>" +
                            //"<td><input type='text' class='location' value='"+element.location+"'/><button class='updateLocation'>Update</button></td>" +
                            "<td class='location'>"+element.location+"</td>" +
                            "<td class='edit'><a><button class='updateLocation' data-toggle='modal' data-target='#updateLocation'>Update</button></a></td>" +
                            "<td class='edit'><a href='waybill?id=" + element.id + "'><input type='button' value='Create POD'/></a></td>" +
                            "<td class='edit invoice'><a><button data-toggle='modal' data-target='#printInvoice'>Print Invoice</button></a></td>" +
                            //"<td class='edit'><a href='print_invoice?id=" + element.id + "'><input type='button' value='Print Invoice'/></a></td>" +
                            "<td class='qty' style='display:none'>"+ element.qty+"</td>" +
                            "<td class='weight' style='display:none'>"+ element.weight+"</td>" +
                            "<td class='type' style='display:none'>"+ element.type+"</td>" +
                            "<td class='remarks' style='display:none'>"+ element.remarks+"</td>" +
                            "<td class='area' style='display:none'>"+ element.area+"</td>" +
                            "<td class='id' style='display:none'>"+ element.id+"</td></tr>"
                        );
                    })
                };
            }
        });
    });

    $(".initialiseInjectedHTML").on('click','.getRowTextDash',function () {
        getRowData($(this));
    });
    $(".getRowText").click(function(){
        getRowData($(this));
    });
    $(".initialiseInjectedHTML").on('click','.updateLocation',function () {
        var location = $(this).closest('tr').find('td.location').text();
        var id = $(this).closest('tr').find('td.id').text();
        console.log('location = '+location+' waybillNo = '+ id);
        $(".modalLocation").val(location);
        $(".modalLocationId").val(id);

    });

    $(".initialiseInjectedHTML").on('click','.invoice',function () {
        var waybillNo = $(this).closest('tr').find('td.waybillNo').text();
        var id = $(this).closest('tr').find('td.id').text();
        console.log("id value = "+id);
        console.log("waybill no value = "+waybillNo);
        var debtorList = [];
        $.ajax({
            url:'debtor',
            type:'get',
            data:{
                id:id
            },
            success:function(response){
                var subcat = $(".modalSelectPayee");
                var data = JSON.parse(response);
                subcat.empty();
                $.each(data, function(index,element) {
                    debtorList.push(element.shipper,element.consignee);
                })
                $.each(debtorList, function(index,value){
                    subcat.append("<option selected value='" + value + "'>" + value + "</option>");
                })
                $(".modalInvoiceId").val(id);
                $(".modalWaybillNo").val(waybillNo);

            }
        });
    });

    $("#outlyingCheckbox").click(function(){
        $("#outlyingInput").toggle(this.checked);
        if($("#outlyingInput").prop("checked")){
            $("#outlyingInput").val('');
        }
    });
    $("#saturdayCheckbox").click(function(){
        $("#saturdayInput").toggle(this.checked);
    });
    $("#vatCheckbox").click(function(){
        $("#vatInput").toggle(this.checked);
    });
    $("#insuranceCheckbox").click(function(){
        $("#insuranceInput").toggle(this.checked);
    });

    $(".finalise").click(function(){
        var id = $(this).closest('tr').find('td.manifestId').text();

        $.ajax({
            url:'finalise',
            type:'post',
            data:{
                id:id
            },
            success:function(){
                alert('Waybill Finalised')
            }
        });
    });

    $(".addRowButton").click(function(){
        $(".dimensions").append('<div class="col-sm-2 addRowButton"></div><label for="Length" class="col-sm-1 col-form-label">Length</label><div class="col-sm-2"><input type="text" class="form-control" name="length[]" value=""></div><label for="width" class="col-sm-1 col-form-label">Width</label><div class="col-sm-2"><input type="text" class="form-control" name="width[]" value=""></div><label for="height" class="col-sm-1 col-form-label">Height</label><div class="col-sm-2"><input type="text" class="form-control" name="height[]" value=""></div>');
    });

    $('#location').editable({
        url : 'updateLocation',
        ajaxOptions : {
            type : 'post'
        },
        success : function(data, config) {
        }
    });

});