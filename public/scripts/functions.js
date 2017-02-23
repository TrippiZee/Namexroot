$(document).ready(function() {

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

    $(".manifestsWaybills").click(function () {
        //var waybillNo = $(this).closest('tr').find('td.shipper').text();
        var waybillNo = $(this).closest('tr').find('td.shipper').val();
        console.log(waybillNo);
        console.log("Still Testing");
        $("modalWaybillNO").val(waybillNo);
    });
});