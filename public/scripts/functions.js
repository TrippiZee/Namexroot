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
        var date = $(this).closest('tr').find('td.date').text();
        var id = $(this).closest('tr').find('td.id').text();
        $(".modalWaybillNO").val(waybillNo);
        $(".modalShipper").val(shipper);
        $(".modalConsignee").val(consignee);
        $(".modalQty").val(qty);
        $(".modalWeight").val(weight);
        $(".modalType").val(type);
        $(".modalRemarks").val(remarks);
        $(".modalDate").val(date);
        $(".modalId").val(id);
    });

    $(".dashboardGetWaybill").click(function(){
        console.log("clicked");
        var manifestId = $(this).closest('tr').find('td.manifestId').text();
        console.log(manifestId);
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
                    subcat.append("<tr><td>NO WAYBILLS EXIST - CREATE A NEW ONE?</td></tr>");
                }else{
                    $.each(data, function(index,element) {
                        subcat.append("<tr><td class='waybillNo'><a href='#' data-toggle='modal' data-target='#editWaybill'>" + element.waybill_no + "</a></td>" +
                            "<td class='date'>" + element.date + "</td>" +
                            "<td>" + element.shipper + "</td>" +
                            "<td>" + element.consignee + "</td>" +
                            "<td><input type='text' value=''/></td>" +
                            "<td class='edit'><a href='waybill?id=" + element.id + "'><input type='button' value='Create POD'/></a></td>" +
                            "<td style='visibility: hidden'>"+ element.manifest_no+"</td></tr>"
                        );
                    })
                };
            }
        });
    });
});