function set_table(tableId, usrLvl)
{
	var boolMutator = function(value, type, data)
	{
		if(value>0){
			return true;
		}
		else {
			return false;
		}
	};
	var printIcon = function(value, data, cell, row, options){
		//plain text value
		//if user level >6 then show print icon.

		if(usrLvl>6){
			return "<i class='glyphicon glyphicon-print'></i>";
		}
		else {
			return "";
		}
	};
	var deleteIcon = function(value,data, cell, row, options){
		if(usrLvl>7){
			return "<i class='glyphicon glyphicon-trash red'></i>";
		}
		else {
			return "";
		}
	};
	var orderLink = function(value){
		return '<a href="order/'+value+'" target="_blank">'+value+'</a>';
	};
	var ddmmyyyy = function(value){
		var orderDate = value.split("-");
		orderDate = orderDate[2] +"/"+orderDate[1]+"/"+orderDate[0];
		return orderDate;
	};
	$('#'+tableId).tabulator({
		ajaxURL:'orders/get_orderlist',
		columns:[

			{formatter:printIcon, width:40, align:"center", onClick:function(e, cell, val, row){alert("Printing row data for: " + row.OmId)}},

			{title:"Order", field:"OmId", sorter:"number", width:100,formatter:orderLink, headerFilter:true},

			{title:"Name", field:"OmCompanyName", sorter:"string", width:500, headerFilter:true},

			{title:"LPO", field:"OmLpo", sorter:"string", width:100},

			{title:"Inv #", field:"InId", sorter:"number", width:100, headerFilter:true},

			{title:"Status", field:"OmStatus", width:100, align:"center", formatter:"tickCross", mutator:boolMutator, headerFilter:true},

			{title:"Store 1", field:"OmStore1", width:100, align:"center", formatter:"tickCross", mutator:boolMutator, headerFilter:true},

			{title:"Store 2", field:"OmStore2", width:100, align:"center", formatter:"tickCross", mutator:boolMutator, headerFilter:true},

			{title:"Printed ?", field:"OmPrinted", width:110, align:"center", formatter:"tickCross", mutator:boolMutator, headerFilter:true},

			{title:"Date", field:"OmCreatedOn", sorter:"date", align:"center", width:110, formatter:ddmmyyyy},

			{formatter:deleteIcon, width:40, align:"center", onClick:function(e, cell, val, row){alert("delete row: " + row.OmId)}},
		],
		rowClick:function(e, id, data, row){
			//trigger an alert message when the row is clicked
        	//alert("Row " + id + " Clicked!!!!");
		},
	});
	$('#'+tableId).tabulator("setData");
}
function load_orders(tableId)
{
	$('#'+tableId).tabulator("clearFilter");
	$('#'+tableId).tabulator("setData","orders/get_orderlist");
}
function stop_autoload(myVar)
{
	clearInterval(myVar);
}
function delete_click(omid)
{
	console.log("delete button clicked"+ omid);
	var liEl = $('li[data-omid="'+omid+'"]');
	var omid = parseInt($(liEl).attr('data-omid'));
	var usrlvl = parseInt($('#username').attr("data-level"));
	// Put confirm dialogue box here
	if (confirm('Are you sure you want to Delete Order:'+omid+'? This Action cannot be reversed.'))
	{
    	console.log('Thanks for confirming');
		$.ajax(
			{
				type: "POST",
				url: "orders/delete_order",
				dataType: "json",
				data:
				{
					omid: omid,
					usrlvl: usrlvl
				},
				success: function(res)
				{
					console.log(res);
					$(liEl).addClass("hidden");
					$(liEl).remove();
				}
			});
	}
	else
	{
    	console.log('Why did you press cancel? You should have confirmed');
		return false;
	}
}


$(document).ready(function()
{
	var usrLvl = parseInt($('#username').attr("data-level"));

	var columnsList = new Array();
	$('.thRow').each(function()
	{
		var colName = $(this).attr('data-colname');
		var col = {"data": (colName=="")? null : colName };
		columnsList.push(col);
	});
	// console.log(columnsList);

	var dataTable = $('#orderlist').DataTable({
		"ajax":{
    		"url": "orders/get_orderlist",
    		"dataSrc": ""
  		},
		"columns": columnsList,
		"columnDefs":
		[
			{
				"targets": 'order',
				"render": function ( data, type, row ) {
					if ( type === 'display')
					{
						return '<a href="order/'+data+'" target="_blank">'+data+'</a>';
					}
					return data;
			 	}
			},
			{
				"targets": 'tickCross',
				"render": function ( data, type, row ) {
					if ( type === 'display')
					{
						if(usrLvl>=7)
						{
							return data>=1? '<a href="order/'+row.OmId+'/print" target="_blank"><span class="glyphicon glyphicon-ok green"></span></a>' : '<a href="order/'+row.OmId+'/print" target="_blank"><span class="glyphicon glyphicon-remove red"></span></a>';
						}
						else
						{
							return data>=1? '<span class="glyphicon glyphicon-ok green"></span>' : '<span class="glyphicon glyphicon-remove red"></span>';
						}

					}
					return data;
			 	}
			},
			{
				"targets": "options",
				"render": function ( data, type, row ) {
					if( type === 'display')
					{
						return '<a href="order/'+row.OmId+'/printinv" target="_blank"><span class="glyphicon glyphicon-print">&nbsp</span></a>  /  <a href="neworder/'+row.OmId+'/Edit" target="_blank">&nbsp<span class="glyphicon glyphicon-pencil">&nbsp</span></a> / <a href="#" class="deleteRow" data-valomid='+row.OmId+'>&nbsp<span class="glyphicon glyphicon-trash"></span></a>';
					}
					return data;
				}
			}
		]
	});
	$('#orderlist tbody').on( 'click', '.deleteRow', function ()
	{
		console.log($(this).attr('data-valomid'));
		var omid = parseInt($(this).attr('data-valomid'));
		var usrlvl = parseInt($('#username').attr("data-level"));
		var tr = $(this).parents('tr');
		// Put confirm dialogue box here
		if (confirm('Are you sure you want to Delete Order:'+omid+'? This Action cannot be reversed.'))
		{
			console.log('Thanks for confirming');
			$.ajax(
			{
				type: "POST",
				url: "orders/delete_order",
				dataType: "json",
				data:
				{
					omid: omid,
					usrlvl: usrlvl
				},
				success: function(res)
				{
					console.log(res);
					dataTable.row( tr ).remove().draw();
				},
				error: function(res)
				{
					console.log(res);
				}
			});
		}

	} );

	setInterval(function()
	{
		if($("#autoReload").attr("data-state") == "TRUE")
		{
			dataTable.ajax.reload(null, false);
			console.log("called");
		}

	}, 10000);
	// Code to handle the pause button
	$("#autoReload").click(function() {
		if($(this).attr("data-state")=="TRUE")
		{
			$(this).attr("data-state","FALSE").removeClass("btn-success").addClass("btn-danger");
		}
		else {
			$(this).attr("data-state","TRUE").removeClass("btn-danger").addClass("btn-success");
		}

	});
});
