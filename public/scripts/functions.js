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
        $(".modalId").val(id);
        //$(".modalmanifestId").val(manifestId);
    }

    $(".dashboardGetWaybill").click(function(){
        $(".addWaybillDashboard").show();
        var manifestId = $(this).closest('tr').find('td.manifestId').text();
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
                    subcat.append("<tr><td></td><td></td><td colspan='5'><h4>NO WAYBILLS EXIST - CREATE A NEW ONE?</h4></td></tr>");
                }else{
                    $.each(data, function(index,element) {
                        subcat.append("<tr><td class='waybillNo getRowTextDash'><a href='#' data-toggle='modal' data-target='#editWaybillDashboard' data-waybillNo='element.waybill_no'>" + element.waybill_no + "</a></td>" +
                            "<td class='date'>" + element.date + "</td>" +
                            "<td class='shipper'>" + element.shipper + "</td>" +
                            "<td class='consignee'>" + element.consignee + "</td>" +
                            "<td><input type='text' class='location' value='"+element.location+"'/><button class='updateLocation'>Update</button></td>" +
                            "<td class='edit'><a href='waybill?id=" + element.id + "'><input type='button' value='Create POD'/></a></td>" +
                            "<td class='edit'><a href='print_invoice?print_id=" + element.id + "'><input type='button' value='Print Invoice'/></a></td>" +
                            "<td class='qty' style='display:none'>"+ element.qty+"</td>" +
                            "<td class='weight' style='display:none'>"+ element.weight+"</td>" +
                            "<td class='type' style='display:none'>"+ element.type+"</td>" +
                            "<td class='remarks' style='display:none'>"+ element.remarks+"</td>" +
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

    $(".initialiseInjectedHTML").on('click','.updateLocation',function () {
        //var location = $('#location').val();
        //var location = $('.location').find('input').val();
        var location = $(this).closest('tr').find('td.location').val();
        var id = $(this).closest('tr').find('td.id').text();
        console.log("clicked location button value = "+location);
        console.log("id value = "+id);
        $.ajax({
            url:'updateLocation',
            type:'post',
            data:{
                location:location,
                id:id
            },
            success:function(){
                alert('Location updated')
            }
        });
    });


});