

$(document).ready(function()
{
	var order_id = $('#order_num').val();
    //On-Load set focus to customer_code element
    $('#customer_code').focus();
    var duedate = getDueDate('date_created','#term_pay');
    $('#due_date').val(duedate);
    //autocomplete customer code. then fill data into customer name and terms of payment
    $('#customer_code').autocomplete({
        source: "customersearch/",
        minLength: 2,
        select: function(event, ui) {
            $('#customer_name').val(ui.item.clconame);
            $('#cur_bal').text(ui.item.clcubal + ui.item.clcudrcr);
            $('#address').val(ui.item.cladd1);
            $('#phone1').val(ui.item.cltel1);
            $('#phone2').val(ui.item.cltel2);
            $('#vat_info').text(ui.item.clvatno);
            $('#term_pay').val(ui.item.clpytime);
            $('#due_date').val(getDueDate('date_created','#term_pay'));
        }
        // source: function(request, response) {
        //     $.ajax({
        //         url: "customersearch/",
        //         dataType: "json",
        //         data: {
        //             term: request.term
        //         },
        //         success: function(data) {
        //             response (data);
        //             console.log(data);
        //         }
        //     });
        // },
        // minLength: 2,
        // select: function(event,ui) {
        //     console.log(ui.item);
        // }
    });
    // $('#customer_code').on('changed.bs.select', function(e,ci,nv,ov){
    //     $('#customer_name').val($(this).val());
    //     console.log($(this).attr('termpay'));
    // // });
    // $('#Qname').on('loaded.bs.select',function(e){
    //     $('#OrderForm').find('button[data-id=Qname]').focus();
    // });


    //toggle forms: make creating order more visible
    $('#open-close-toggle').on('click',function(){
        //#toggle-section is the Element to Toggle
        //.toggle-section is the up-down arrow image to toggle.
        $('#toggle-section').slideToggle(function() {
            $('.toggle-section').toggle();
        });
    });
    //Discount change
    $('#discount').on('change',function(){
    	var discount = parseFloat($(this).val());
    	if(isNaN(discount)){
    		$(this).val('0.00');
    	}
    	else{
    		var total_amount = parseFloat($('#total_amount').val());
    		if(total_amount <= discount){
    			console.log("Not A valid Discount");
    			$(this).val('0.00');
    		}
    	}
    	calculateNetAmount();
    });
    //make invoie. this is gonna be another problematic code.
    $('#make_invoice').on('click',function(){
    	//first, I need to check if the Order has been saved.
    	//To check that, I can check if #order_num has value set to it.
    	console.log("clicked");
    	if(order_id == ""){
    		//This means order is not saved yet.
    		//show msge to user to save the order first.

    		//this is cause i dont have time to trigger the event myself and
    		//get the order_id myself cause i don't know how long it will take before click even is complete.

    		// $('#save').trigger('click');
    		alert("Please save the order first");
    	}else{
    		//this means order_id is set.
    		//now i need to use this number to make invoice
    		console.log("ajax starting");
    		$.ajax({
    			url: 'orders/make_invoice',
    			type: 'POST',
    			dataType: 'json',
    			data: {
    				order_id: order_id,
    				vat_percent: $('#vat').attr('data-vat-val'),
    				due_date: $('#due_date').val(),
    				username: $('#username').attr("data-username")
    			},
    		})
    		.done(function(res) {
    			console.log("make invoice success"+res);
    			$('#invoice_num').val(res);

    		})
    		.fail(function() {
    			console.log("error");
    		})
    		.always(function() {
    			console.log("complete");
    		});

    	}
    });



    //important function below, it selects all text in QTY field when focusin
    $("input[type=number]").focus(function()
    {
        $(this).select();
    });
	//left or right qty change.
	$(".qty").change(function(event)
	{
        ////console.log("qty changed");
		$("#Total_").val(parseInt($("#Qty_L").val())+parseInt($("#Qty_R").val()));
	});
	//total qty change

	//remove record function
	$("#Output").on('click','.record',function(){
		var indexval = $(this,"td:first").html() - 1;
		////console.log(indexval);
		$my_global_order.splice(indexval,1);
		$(this).parent().remove();
		////console.log($my_global_order);
		calculateNetAmount();
        // var total = 0.00;
        // $(".record").each(function(i)
        // {
        //     total = parseFloat(total) + parseFloat($(this).siblings(".amount").html());
        //     ////console.log("i : "+ i);
        //     $(this).html(i+1);
        // });
        // $("#total_amount").val(parseFloat(total).toFixed(2));
	});
	//save order function
	$("#save").on('click',function()
	{
		if($(this).attr("disabled"))
		{
			console.log("already saved");
			return false;
		}
		var orderform = $( "#form_details" );
		orderform.validate();
		if(orderform.valid()===false || $my_global_order.length === 0)
		{
			console.log("Cant save. Customer details form not valid");
			return;
		}
		//console.log($my_global_order);
		//console.log("order var above");
		$(this).attr("disabled","true");
		$.ajax(
		{
	        type: "POST",
	        url: "orders/save_order",
	        dataType: 'json',
	        data:
			{
				code: $('#customer_code').val().toUpperCase(),
	            name: $('#customer_name').val().toUpperCase(),
	            lpo: $('#lpo').val().toUpperCase(),
	            paytime: $('#term_pay').val(),
	            date: $('#date_created').val(),
	            address: $('#address').val(),
	            tel1: $('#phone1').val(),
	            tel2: $('#phone2').val(),
	            discount: parseFloat($('#discount').val()),
				username: $('#username').attr("data-username"), //thats just formality. PHP will check session and level
	            orderdata: $my_global_order
	        },
	        success: function(res)
	        {
				// #something is a Div. so i will append the order number.
	            $("#something").attr("class","alert fz-success alert-dismissable fade in").append("Number: <strong>"+res+"</strong>");
	            $('#order_num').val(res);
	            order_id = res;
	            // window.location.replace("order/"+res);
	            console.log(res);
	        },
	        error: function(request, status, error)
	        {
	        	//need to flash msg to notify error.
	        	//need to enable save button again.
	        	console.log(request.responseText);
	        	$(this).removeAttr("disabled");

	        }
	    });


	});
	//toggle cost on Stock click
	$('#info_stock').parent().on('click',function(){
		$('#info_cost').parent().parent().toggleClass("hidden");
	});
	//calculate Due Date
	$('#term_pay').on('change', function(){
		$('#due_date').val(getDueDate('date_created','#term_pay'));
	});
	//testing function
	$("#total").on('click',function()
	{
		console.log($('#username').attr("data-username"));

	});

	$('#Part_no').focusout(function(){

	});
	$(window).bind('beforeunload', function()
    {

		// var saveState = $('save').attr("disabled");
		console.log($testglobaldata);
		// console.log($('#save').attr("disabled"));

        if($my_global_order.length>0 && ($('#save').attr("disabled") != "disabled"))
  		{

  			return  'Are you sure you want to leave?';
  		}
		else {
			console.log('length: '+ $my_global_order.length + '  State: '+ ($('save').attr("disabled")));
		}
        // if($my_global_order.length>0)
		    // {
        //     return 'Are you sure you want to leave?';
		    // }
    });
});
/*
	//SEND A HTTP REQUEST WITH AJAX
	var no_len =$('#Part_no').val();
	//alert(event.which);

	$.ajax({
	url: 'getdesc.php',
	data: 'q='+$('#Part_no').val(),
	dataType: 'json',
	success: function(data)
	{
		var desc=data[0]+" /- "+data[1];
		var ssno=data[1];

		// UPDATE HTML CONTENT
		$('#Desc_').val(desc);
		$('#Desc_').load()
		//$('#Price_').val(ssno);
	}

	});
	*/



//jquery stuff
