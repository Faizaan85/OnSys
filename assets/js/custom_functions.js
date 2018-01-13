// JavaScript Document

var $my_global_order = [];
var $my_counter = 0;
//shorcuts.
shortcut.add("F2", function()
{
	// alert($('#customer_code').val().toUpperCase());
	// alert($('#customer_name').val().toUpperCase());
    $("#save").click();
});
shortcut.add("F4", function()
{

    $("#cancel_new").click();
});
shortcut.add("F9", function()
{
    $("#Part_no").focus();
});

//bootstrap-selects
// $('.selectpicker').selectpicker({
//   style: 'btn-success',
//   size: 10
// });


//functions
function disp_data($i)
{
        document.getElementById($i);//here also what to do.
}
function setfocus(objectid)// this is for the textbox to get focus onload.
{
        document.getElementById(objectid).focus();
        console.log(objectid);
}
//
// function Toggle_Hide_Show(eid)
// {
//         if(document.getElementById(eid).className=="tab_cell_show")
//         {
//             document.getElementById(eid).className="tab_cell_hidden";
//         }
//         else
//         {
//             document.getElementById(eid).className="tab_cell_show";
//         }
//
//         //document.getElementById('hideShow').style.visibility='hidden';
// }
function GetProductTrans(part_no)
{
    console.log($base_url);
		part_no = part_no.replace(/[^\w\s]/gi,'');
        var custnum="ALL";
        var str1="Item_Trans.php?part_no=";
        var str2= str1.concat(part_no,"&cust=ALL");
        window.open(str2,'_self');
        //document.getElementById(part_no.concat("1")).innerHTML=str2;
}
function allowButton(e,type="ALL")
{
	var kkey = e.charCode || e.keyCode || 0;
    // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
    // home, end, period, and numpad decimal
	var key = e.key;
	// console.log($.isNumeric(key));
	if($.isNumeric(key) || key=='.' || key =='Tab' || key == 'Enter' || key=='Backspace' || key == 'Delete' || key == 'Home' || key == 'End')
	{
		return e.key;
	}
	else {
		e.preventDefault();
		return false;
	}

	// if(type=="number" && key!=13)
	// {
	// 	if(key == 8 || key == 9 || key == 13 || key == 46 || key == 110 || key == 190 || (key >= 35 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))
	// 	{
	// 		return e.keyCode;
	// 	}
	// 	else
	// 	{
	// 		e.preventDefault();
	// 		return false;
	// 	}
	// }
}
function whichButton(e,str,type="ALL")
{
	//alert("got a key = " + e.keyCode);


	if (e.keyCode == 13 && str=="Add_Row")
	{
		addRow('Output');
		var followingInput = document.getElementById("Part_no");
		followingInput.focus();
	}
	else if (e.keyCode == 13 && str=="Qty_R")
	{
		// this means ENTER key was pressed at Part No input box
		//SEND A HTTP REQUEST WITH AJAX
		var partNo = $('#Part_no').val();
		if($.trim(partNo) == "")
		{
			return;
		}
		$.getJSON("items/get_part_details/"+partNo ,function(data)
        {
	            // console.log(data);
		}).done(function(data){
			// Success Return
			$('#Desc_').val(data.DESC);
			$('#Supplier_no').val(data.SSNO);
			$('#Price_').val(data.SALES_PRIC);
			$('#Price_').attr("data-tgp",data.UNIT_COST); //Setting unit cost
			$('#info_cost').text(data.UNIT_COST);
			$('#info_stock').text(data.QTY_HAND);
		}).fail(function(){
			// Failed Return
			alert("Part Number NOT found.");
			$("#Part_no").focus();
		});
		var followingInput = document.getElementById(str);
		followingInput.focus();
	}
	else if (e.keyCode == 13)
	{
		var followingInput = document.getElementById(str);
		followingInput.focus();
	}
}
function CancelOrder()
{
    window.location.replace("neworder");
}
function clearInput()
{
	$("#Part_no").val('');
	$("#Supplier_no").val('');
	$("#Desc_").val('');
	$("#Qty_R").val('0');
	$("#Qty_L").val('0');
	$("#Total_").val('0');
	$("#Price_").val('0');
	$('#Price_').attr("data-tgp","-1");
    $('#info_cost').parent().parent().addClass("hidden");
    $('#info_cost').text('');
    $('#info_stock').text('');
	// document.getElementById("").value="";
	// document.getElementById("").value="";
	// document.getElementById("").value="";
	// document.getElementById("Qty_R").value="0";
	// document.getElementById("Qty_L").value="0";
	// document.getElementById("Total_").value="0";
	// document.getElementById("Price_").value="";


    // Clearing unit cost. setting to -1 cause Unit cost can be 0 but cant be -1.
    // So if its -1. its a flag to not allow entry
}
function getDueDate(dateEl, payTimeEl){
    var createddate = new Date($('#'+dateEl).val());
    var add_days;
    console.log($(payTimeEl).val());
    switch($(payTimeEl).val()) {
    case 'Cash':
        add_days = 0;
        break;
    case '30 Days':
        add_days = 30;
        break;
    case '60 Days':
        add_days = 60;
        break;
    case '90 Days':
        add_days = 90;
        break;
    case '120 Days':
        add_days = 120;
        break;
    default:
        add_days = 0;
}

    createddate.setDate(createddate.getDate() + add_days);
     //Using this we can convert any date format to JS Date

    var mm = createddate.getMonth() + 1; // getMonth() is zero-based

    var dd = createddate.getDate();

    if(mm<10){
      mm="0"+mm;
    }
    if(dd<10){
      dd="0"+dd;
    }
    return [createddate.getFullYear(), mm, dd].join('-'); // padding
    console.log(createddate);
}
function calculateNetAmount()
{
	var total_amount, discount, vat_value, net_amount;
	total_amount =0.00;
	net_amount = 0.00;
	if(isNaN(parseFloat($('#discount').val())))
	{
		discount = 0.00;
	}
	else
	{
		discount = parseFloat($('#discount').val()).toFixed(2);
	}

    vat_value = parseFloat($('#vat').attr('data-vat-val')).toFixed(2);

    //loop to calculate total amount
    var amt =0.00;
	$(".record").each(function(i)
    {
        amt = parseFloat($(this).siblings(".amount").html());
        if(isNaN(amt))
        {
          amt=0.00;
        }
        total_amount = parseFloat(total_amount) + (amt);
        ////console.log(total);
        $(this).html(i+1);
    });
    //#calculations
    $("#total_amount").val( parseFloat(total_amount).toFixed(2));
    vat_amount = parseFloat(((total_amount-discount)*vat_value)/100).toFixed(2);
    // console.log(vat_amount);
    $('#vat').val(vat_amount);
    net_amount = parseFloat(total_amount-discount).toFixed(2);
    net_amount = parseFloat(net_amount)+parseFloat(vat_amount);
    $('#net_amount').val(parseFloat(net_amount).toFixed(2));

}

//
// function makexmlhttp()
// {
// 	if (window.XMLHttpRequest)
//   	{// code for IE7+, Firefox, Chrome, Opera, Safari
//   		xmlhttp=new XMLHttpRequest();
//   	}
// 	else
//   	{// code for IE6, IE5
//   		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//   	}
// 	return xmlhttp;
// }
/*
function getDesc(str)
{
if (str=="")
  {
  document.getElementById("Desc_").value="abc";
  return;
  }
xmlhttp = makexmlhttp();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("Desc_").value=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getdesc.php?q="+str,true);
xmlhttp.send();
}*/
function addRow(tableID)
{
    var addrowform = $("#form_input");
    var price_tgp = parseFloat($("#Price_").attr("data-tgp"));

    addrowform.validate();

//Part No
    var partno =document.getElementById("Part_no").value;
    partno = partno.replace(/[^\w\s]/gi,'').toUpperCase();

//Supplier no
    var supplierno= document.getElementById("Supplier_no").value;
//Description
    var desc = document.getElementById("Desc_").value;
//QTY_R
    var qtyr =  document.getElementById("Qty_R").value;
    if (qtyr=="")
    {
        qtyr = 0;
    }
//QTY_L
    var qtyl =  document.getElementById("Qty_L").value;
    if (qtyl=="" )
    {
		qtyl=0;
    }

//Total_

    var qtyt =  parseInt(document.getElementById("Total_").value);
    if(qtyt <= 0 || qtyt === null || isNaN(qtyt))
    {
            alert("Invalid Total Quantity");
            $('#Total_').focus();
    }
    else
    {

    //Price_
        var price = parseFloat($("#Price_").val()).toFixed(2);
    // Amount
        var amount = parseFloat(parseFloat(qtyt)*price).toFixed(2);
    //Validation
        console.log(supplierno);
        if(addrowform.valid() === false ||  price_tgp >= price || desc=="" || price_tgp == -1 || isNaN(price))
        {
            alert("Invalid Item");
            return;
        }
    //Adding to global variable
        $my_global_order.push([partno,supplierno,desc,qtyr,qtyl,qtyt,price]);
        var markup = "<tr><td class='record'> </td><td>" + partno + "</td><td>" + supplierno + "</td><td>" + desc + "</td><td>" + qtyr + "</td><td>" + qtyl + "</td><td>" + qtyt + "</td><td>" + price + "</td><td class='amount'>" + amount + "</td></tr>";
        var tableid = document.getElementById(tableID);
    //Adding to table.
        $(tableid).append(markup);

        calculateNetAmount();
        // var total = 0.00;
        // var discount = $('#discount').val();
        // var vat_value = parseFloat($('#vat').attr('data-vat-val')).toFixed(2);
        // var vat_amount;
        // //loop to calculate total amount
        // $(".record").each(function(i)
        // {
        //     total = parseFloat(total) + parseFloat($(this).siblings(".amount").html());
        //     ////console.log(total);
        //     $(this).html(i+1);
        // });
        // //#calculations
        // $("#total_amount").val( parseFloat(total).toFixed(2));
        // vat_amount = parseFloat(((total-discount)*vat_value)/100).toFixed(2);
        // // console.log(vat_amount);
        // $('#vat').val(vat_amount);
        // $('#net_amount').val((parseFloat(total-discount)+parseFloat(vat_amount)));
        $('#Part_no').focus();
    }
}

