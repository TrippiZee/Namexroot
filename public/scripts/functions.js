$(document).ready(function() {

    $("#dimensions").hide();

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
        }
    });
    $(".waybills").dataTable({
        "processing": true,
        "serverSide":true,
        "ajax":{
            //url:"includes/controllers/waybills.php",
            url:"ajaxWaybills",
            type:"post"
        }
    });
    $(".pods").dataTable({
        "processing": true,
        "serverSide":true,
        "ajax":{
            //url:"includes/controllers/pods.php",
            url:"ajaxPods",
            type:"post"
        }
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

    $(".getRowText").click(function () {
        //var waybillNo = $(this).closest('tr').find('td.shipper').text();
        var waybillNo = $(this).closest('tr').find('td.waybillNo').text();
        var shipper = $(this).closest('tr').find('td.shipper').text();
        var consignee = $(this).closest('tr').find('td.consignee').text();
        var qty = $(this).closest('tr').find('td.qty').text();
        var weight = $(this).closest('tr').find('td.weight').text();
        var type = $(this).closest('tr').find('td.type').text();
        var remarks = $(this).closest('tr').find('td.remarks').text();
        $(".modalWaybillNO").val(waybillNo);
        $(".modalShipper").val(shipper);
        $(".modalConsignee").val(consignee);
        $(".modalQty").val(qty);
        $(".modalWeight").val(weight);
        $(".modalType").val(type);
        $(".modalRemarks").val(remarks);
    });
});