$(document).ready(function()
{   var order_id ;
	var inv_id;
	if($global_mode == "Edit"){
		$('#date_created').attr("disabled","disabled");
		var duedate = getDueDate('date_created','#term_pay');
    	$('#due_date').val(duedate);
    	order_id = $('#order_num').val();
		inv_id = $('#inv_num').val();
		// $('#date_created').attr()
		calculateNetAmount();

	}
	$('#term_pay').on('change', function(){
		$('#due_date').val(getDueDate('date_created','#term_pay'));
	});

	//toggle forms: make creating order more visible
    $('#open-close-toggle').on('click',function(){
        //#toggle-section is the Element to Toggle
        //.toggle-section is the up-down arrow image to toggle.
        $('#toggle-section').slideToggle(function() {
            $('.toggle-section').toggle();
        });
    });

    //make invoie. this is gonna be another problematic code.
    $('#make_invoice').on('click',function(){
    	//first, I need to check if the Order has been saved.
    	//To check that, I can check if #order_num has value set to it.
		$(this).attr("disabled","disabled");
    	console.log("clicked");
    	var totamount = $('#total_amount').val();
    	totamount = +totamount;
    	if(order_id == ""){
    		//This means order is not saved yet.
    		//show msge to user to save the order first.

    		//this is cause i dont have time to trigger the event myself and
    		//get the order_id myself cause i don't know how long it will take before click even is complete.

    		// $('#save').trigger('click');
			$(this).removeAttr("disabled");
    		alert("Please save the order first");
    	}else if(inv_id !=""){
			//this means Invoice already made. dont create any more errors by pressing make invoice.

		}else if(totamount>0.00){
    		//this means order_id is set.
    		//now i need to use this number to make invoice

    		console.log("ajax starting");
    		$.ajax({
    			url: $base_url+'orders/make_invoice',
    			type: 'POST',
    			dataType: 'json',
    			data: {
    				order_id: order_id,
    				vat_percent: $('#vat').attr('data-vat-val'),
    				due_date: $('#due_date').val(),
    				username: $('#username').attr("data-username")
    			},
				success: function(res)
				{
					// #something is a Div. so i will append the order number.
					$('#inv_num').val(res);
					console.log("result"+res);
					$.ajax({
						url: $base_url+'orders/set_print_state',
						type: 'POST',
						dataType: 'json',
						data: {
							orderid: order_id,
							status: 1
						},
						success: function(res)
						{
							console.log("Printed status set.");
							$('#make_invoice').css("background-color","red");
						},
						error: function(request, status, error)
						{
							//need to put console only to mention to admin the order number that wasnt set to printed;
							console.log(request.responseText);
						}
					});
				},
	        error: function(request, status, error)
	        {
	        	//need to flash msg to notify error.
	        	//need to enable save button again.
	        	console.log(request.responseText);
	        	$(this).removeAttr("disabled");

	        }});
    	}
    	else{
    		alert("CANNOT MAKE INVOICE WITH 0 ITEMS");
    	}
    });
});
