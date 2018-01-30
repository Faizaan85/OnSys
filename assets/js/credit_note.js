var Invoice;
function clearTab(t_id)
{
	$('.row_tab').remove();
	$("li[role='tab']").remove();
	// $(t_id).empty();
	// $(t_id).append('<ul></ul>');
}
function addInvTab(t_label, data)
{
	$('.tabs-ul').append('<li><a href="#'+t_label+data.im.InId+'">Inv:'+data.im.InId+'</a></li>');
    // let tab_inv = `<div id="${t_label}${data.im.InId}" class="row_tab container-fluid">
    //     <div class="row details">
    //         <div class="row">
    //             <div class="col-sm-3 col-md-3 col-lg-3">
    //                 <label >Inv No:</label>
    //                 <span >${data.im.InId}</span>
    //             </div>
    //             <div class="col-sm-3 col-md-3 col-lg-3">
    //                 <label >Order No:</label>
    //                 <span >${data.im.InOmId}</span>
    //             </div>
    //             <div class="col-sm-3 col-md-3 col-lg-3">
    //                 <label >Date:</label>
    //                 <span >${data.im.InOmCreatedOn}</span>
    //             </div>
    //             <div class="col-sm-3 col-md-3 col-lg-3">
    //                 <label >Vat No:</label>
    //                 <span >${data.im.ClVatNo}</span>
    //             </div>
    //         </div>
    //         <div class="row">
    //             <div class="col-sm-2 col-md-2 col-lg-2">
    //                 <label >Code:</label>
    //                 <span>${data.im.InOmCompanyCode}</span>
    //             </div>
    //             <div class="col-sm-3 col-md-3 col-lg-3">
    //                 <label >Name:</label>
    //                 <span>${data.im.InOmCompanyName}</span>

    //             </div>
    //             <div class="col-sm-3 col-md-3 col-lg-3">
    //                 <label >LPO:</label>
    //                 <span>${data.im.InOmLpo}</span>
    //             </div>
    //             <div class="col-sm-4 col-md-4 col-lg-4 text-right">
    //                 <div class="row">
    //                     <div class="col-sm-6 col-md-6 col-lg-6">
    //                         <label >Total Amount:</label>
    //                     </div>
    //                     <div class="col-sm-3 col-md-3 col-lg-3">
    //                         <span class="text-right">${data.im.InAmount}</span>
    //                     </div>
    //                 </div>
    //                 <div class="row">
    //                     <div class="col-sm-6 col-md-6 col-lg-6">
    //                         <label >Total Discount:</label>
    //                     </div>
    //                     <div class="col-sm-3 col-md-3 col-lg-3">
    //                         <span class="text-right">${data.im.InDiscount}</span>
    //                     </div>
    //                 </div>
    //                 <div class="row">
    //                     <div class="col-sm-6 col-md-6 col-lg-6">
    //                         <label >${data.im.InVatPercent} % VAT:</label>
    //                     </div>
    //                     <div class="col-sm-3 col-md-3 col-lg-3">
    //                         <span class="text-right">${data.im.InVatAmount}</span>
    //                     </div>
    //                 </div>
    //                 <div class="row">
    //                     <div class="col-sm-6 col-md-6 col-lg-6">
    //                         <label >Net Amount:</label>
    //                     </div>
    //                     <div class="col-sm-3 col-md-3 col-lg-3">
    //                         <label class="text-right"><strong>${data.im.InNetAmount}</strong></label>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>
    //         <div class="row">
    //             <div class="col-sm-4 col-md-4 col-lg-4">
    //                 <label for="">Address:</label>
    //             </div>
    //             <div class="col-sm-4 col-md-4 col-lg-4">
    //                 <label for="">Phone 1:</label>
    //             </div>
    //             <div class="col-sm-4 col-md-4 col-lg-4">
    //                 <label for="">Phone 2:</label>
    //             </div>
    //         </div>
    //     </div>
    //     <div class="row items">
    //         <table id="table_${t_label}${data.im.InId}" class="table table-striped table-bordered">
    //             <tr>
    //                 <th>Select</th>
    //                 <th>Part #</th>
    //                 <th>Supplier#</th>
    //                 <th>Description</th>
    //                 <th>Left Qty</th>
    //                 <th>Right Qty</th>
    //                 <th>Total Qty</th>
    //                 <th>Price</th>
    //                 <th>Amount</th>
    //             </tr>`;
	let inv_items;
    for (var item in data.ii)
    {
        inv_items = inv_items + '<tr>';
        inv_items = inv_items + '<td > <input type="checkbox" value="item" value='+data.ii[item].IiId+' /></td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiPartNo+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiSupplierNo+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiDescription+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiLeftQty+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiRightQty+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiTotalQty+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiPrice+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiAmount+'</td>';
        inv_items = inv_items + '</tr>';
        // console.log(item + ":"+ data.ii[item].IiOiPartNo);

        //console.log(data.ii[item]);
    }


    $('#tabs').append(tab_inv+ inv_items+`
            </table>

        </div>
    </div>`);
	$( "#tabs" ).tabs('refresh');
}
function unhideTab(data)
{
    $('#inv_id').text(data.im.InId);
    $('#inv_omid').text(data.im.InOmId);
    $('#inv_createdon').text(data.im.InOmCreatedOn);
    $('#inv_clvat').text(data.im.ClVatNo);
    $('#inv_ccode').text(data.im.InOmCompanyCode);
    $('#inv_cname').text(data.im.InOmCompanyName);
    $('#inv_lpo').text(data.im.InOmLpo);


    let inv_items ="";
    $('.loaded-data').remove();
    for (var item in data.ii)
    {
        inv_items = inv_items + '<tr class="loaded-data">';
        inv_items = inv_items + '<td > <input type="checkbox" name="item" value='+data.ii[item].IiId+' /></td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiPartNo+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiSupplierNo+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiDescription+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiLeftQty+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiRightQty+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiTotalQty+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiPrice+'</td>';
        inv_items = inv_items + '<td>'+ data.ii[item].IiOiAmount+'</td>';
        inv_items = inv_items + '</tr>';
        // console.log(item + ":"+ data.ii[item].IiOiPartNo);
        $('#inv_table').append(inv_items);
        inv_items ="";
        //console.log(data.ii[item]);
    }

    $('#tabs').show();

}

$(document).ready(function()
{
    $( "#tabs" ).tabs({collapsible: true});
    // console.log("ran at least");

    $("#btn_inv_search").on('click',function(){
    	// console.log("clicked");
    	$.ajax({
    		url: $base_url+'returns/get_invoice',
    		type: 'GET',
    		dataType: 'json',
    		data: {inv_id: $('#inv_search').val()},
    	})
    	.done(function(result) {
    		console.log("success");
            //result will have 2 objects
            //result.ii and result.im
    		// console.log(result);
    		// console.log(result.InAmount);
    		Invoice = result;

    		//clearTab("#tabs");
            unhideTab(Invoice);
            //addInvTab("Inv_", Invoice);

            // $.ajax({
            //     url: $base_url+'returns/get_credit_notes',
            //     type: 'GET',
            //     dataType: 'json',
            //     data: {inv_id: 'value1'},
            // })
            // .done(function() {
            //     console.log("success");
            // })
            // .fail(function() {
            //     console.log("error");
            // })
            // .always(function() {
            //     console.log("complete");
            // });

    	})
    	.fail(function(reque,stat,error) {
    		console.log("error");
    		clearTab("#tabs");
    		alert(reque);
    	})
    	.always(function() {
    		console.log("complete");
    	});
    });


    $('#inv_next').on('click',function(){
        let return_items = '';
        $('.return-loaded-data').remove();
        $.each($("input[name='item']:checked"), function(){
            let i = $(this).val();

            for(var item in Invoice.ii)
            {
                if(i == Invoice.ii[item].IiId)
                {
                    return_items = return_items + '<tr id="'+Invoice.ii[item].IiId+'" class="return-loaded-data item-row">';
                    return_items = return_items + '<td  id="part_'+i+'">'+ Invoice.ii[item].IiOiPartNo+'</td>';
                    return_items = return_items + '<td id="ssno_'+i+'">'+ Invoice.ii[item].IiOiSupplierNo+'</td>';
                    return_items = return_items + '<td id="desc_'+i+'">'+ Invoice.ii[item].IiOiDescription+'</td>';

                    if(Invoice.ii[item].IiOiLeftQty == "0")
                    {
                        return_items = return_items + '<td><input id="lqty_'+i+'" class="rtn_input" type="number" min="0" max="'+Invoice.ii[item].IiOiLeftQty+'"  value="'+ Invoice.ii[item].IiOiLeftQty+'"  data-iiid = "'+Invoice.ii[item].IiId+'" disabled/></td>';
                        //return_items = return_items + '<td>'+Invoice.ii[item].IiOiLeftQty+'</td>';
                    }else
                    {
                        return_items = return_items + '<td><input id="lqty_'+i+'" class="rtn_input" type="number" min="0" max="'+Invoice.ii[item].IiOiLeftQty+'"  value="'+ Invoice.ii[item].IiOiLeftQty+'"  data-iiid = "'+Invoice.ii[item].IiId+'"/></td>';
                    }
                    if(Invoice.ii[item].IiOiRightQty == "0")
                    {
                        return_items = return_items + '<td><input id="rqty_'+i+'" class="rtn_input" type="number" min="0" max="'+Invoice.ii[item].IiOiRightQty+'"  value="'+ Invoice.ii[item].IiOiRightQty+'" data-iiid = "'+Invoice.ii[item].IiId+'" disabled/></td>';
                        //return_items = return_items + '<td>'+Invoice.ii[item].IiOiRightQty+'</td>';
                    }else
                    {

                        return_items = return_items + '<td><input id="rqty_'+i+'" class="rtn_input" type="number" min="0" max="'+Invoice.ii[item].IiOiRightQty+'"  value="'+ Invoice.ii[item].IiOiRightQty+'" data-iiid = "'+Invoice.ii[item].IiId+'"/></td>';
                    }
                    if(Invoice.ii[item].IiOiLeftQty == "0" && Invoice.ii[item].IiOiRightQty == "0")
                    {
                        return_items = return_items + '<td><input id="tqty_'+i+'" class="rtn_input" type="number" min="0" max="'+Invoice.ii[item].IiOiTotalQty+'"  value="'+ Invoice.ii[item].IiOiTotalQty+'" data-iiid = "'+Invoice.ii[item].IiId+'"/></td>';
                    }else
                    {
                        return_items = return_items + '<td ><input id="tqty_'+i+'" class="rtn_input" type="number" min="0" max="'+Invoice.ii[item].IiOiTotalQty+'"  value="'+ Invoice.ii[item].IiOiTotalQty+'" data-iiid = "'+Invoice.ii[item].IiId+'" disabled/></td>';
                        // return_items = return_items + '<td>'+Invoice.ii[item].IiOiTotalQty +'</td>';
                    }
                    return_items = return_items + '<td><input id="price_'+i+'" type="number" value="'+ Invoice.ii[item].IiOiPrice+'" disabled/></td>';
                    return_items = return_items + '<td><input id="amount_'+i+'" type="number" class="td-amount" value="'+ Invoice.ii[item].IiOiAmount+'" disabled/></td>';
                    return_items = return_items + '</tr>';
                    // console.log(item + ":"+ Invoice.ii[item].IiOiPartNo);
                    $('#rtn_table').append(return_items);
                    return_items ="";
                }
            }
            // return_items = return_items + $(this).html();
            // return_items = return_items + '</tr>';
            // // console.log(item + ":"+ data.ii[item].IiOiPartNo);
            // $('#rtn_table').append(return_items);
            // return_items ="";
            // // alert($(this).val());
        });
        // $(".return-loaded-data:nth-child(5)").append('<input type="number" value="0"/>');
        return_items = `<tr class="return-loaded-data"> <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total Amount:</td>
            <td><input id="rtn_total" type="number" value="`+Invoice.im.InAmount+`" disabled/></td></tr>`;
        return_items = return_items + `<tr class="return-loaded-data">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Discount:</td>
            <td><input id="rtn_discount" type="number" value="0" disabled/></td></tr>`;
        return_items = return_items + `<tr class="return-loaded-data">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>VAT `+Invoice.im.InVatPercent+`% :</td>
            <td><input id="rtn_vat_amount" type="number" value="`+Invoice.im.InVatAmount+`" disabled/></td></tr>`;
        return_items = return_items + `<tr class="return-loaded-data">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Net Return Amount:</strong></td>
            <td><input id="rtn_net_amount" type="number" value="`+Invoice.im.InNetAmount+`" disabled/></td></tr>`;
        $('#rtn_table').append(return_items);
        return_items ="";
        $("#tabs").tabs({active:1});
        // alert("val-=--"+values.join(", "));
        // alert("Dynamic button action");
    });


    $(document).on('change','.rtn_input', function(event) {
        // event.preventDefault();
        // alert('haaaasss!!!');
        /* Act on the event */
        let id = $(this).attr('data-iiid');
        // alert(id);
        // let total_qty = parsInt($('#lqty_'+id).val())+parsInt($('#rqty_'+id).val());

        let total_qty, left_qty, right_qty, price;
        left_qty = $('#lqty_'+id).val();
        right_qty = $('#rqty_'+id).val();
        price = $('#price_'+id).val();


        //check if total_qty = disabled
        if($('#tqty_'+id).attr("disabled")== "disabled")
        {
            //means left and right are enabled
            total_qty = math.add(left_qty, right_qty);
        }
        else
        {
            total_qty = $('#tqty_'+id).val();
        }

        //set total quantity value.
        $('#tqty_'+id).val(total_qty);
        //set amount value
        $('#amount_'+id).val(math.multiply(total_qty,price).toFixed(2));

        var total_amount = 0.00;
        $('.td-amount').each(function(index, el) {
            total_amount = math.add(total_amount,$(this).val()).toFixed(2);
        });
        $('#rtn_total').val(total_amount);
        $('#rtn_vat_amount').val(math.multiply(total_amount,0.05).toFixed(2));
        $('#rtn_net_amount').val(math.add(total_amount,$('#rtn_vat_amount').val()).toFixed(2));

        // console.log(event);
        // console.log(total_qty);



    });
    $('#rtn_save').on('click',function(){
        //ok, so now the fucking data collection starts,,
        // lets create 2 objects.. not again
        // 1st will be creditnotemaster data and 2nd for its items.
        // i need to have a better way for this fucking process,, 3rd time i'm doing this.
		$(this).attr('Disabled','Disabled');
        var cn_master = {
            inv_id : Invoice.im.InId,
            company_code: Invoice.im.InOmCompanyCode,
            lpo: Invoice.im.InOmLpo,
            cn_amount: $('#rtn_total').val(),
            cn_discount:$('#rtn_discount').val(),
            cn_vat_percent: Invoice.im.InVatPercent,
            cn_vat_amount:$('#rtn_vat_amount').val(),
            cn_net_amount:$('#rtn_net_amount').val()
        };
        var cn_items = [];
        var cn_item = {};
        var iiid;
        $('.item-row').each(function(index, el) {
            iiid = this.id;
            cn_item.iiid = iiid;
            cn_item.partno = $('#part_'+iiid).text();
            cn_item.ssno = $('#ssno_'+iiid).text();
            cn_item.desc = $('#desc_'+iiid).text();
            cn_item.lqty = math.multiply($('#lqty_'+iiid).val(),1);
            cn_item.rqty = math.multiply($('#rqty_'+iiid).val(),1);
            cn_item.tqty = math.multiply($('#tqty_'+iiid).val(),1);
            cn_item.price = $('#price_'+iiid).val();
            cn_items.push([cn_item.iiid,cn_item.partno,cn_item.ssno,cn_item.desc,cn_item.lqty,cn_item.rqty,cn_item.tqty,cn_item.price]);
            cn_item = {};
        });
        console.log(cn_items);
        $.ajax({
            url: 'returns/post_credit_note',
            type: 'POST',
            dataType: 'json',
            data: {
                inv_id : Invoice.im.InId,
                company_code: Invoice.im.InOmCompanyCode,
                lpo: Invoice.im.InOmLpo,
                cn_amount: $('#rtn_total').val(),
                cn_discount:$('#rtn_discount').val(),
                cn_vat_percent: Invoice.im.InVatPercent,
                cn_vat_amount:$('#rtn_vat_amount').val(),
                cn_net_amount:$('#rtn_net_amount').val(),
                items: cn_items
            },
        })
        .done(function(result) {
            console.log("success: "+result);
            window.location.replace($base_url+'returns/print_credit_note/?cn_id='+result);
        })
        .fail(function(request) {
            console.log("error");
            console.log(request.responseText);
        })
        .always(function() {
            console.log("complete");
            console.log(cn_master);
        });



    });

});
