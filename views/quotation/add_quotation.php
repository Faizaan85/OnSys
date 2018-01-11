<style>
.text-error
{
	 color: #b94a48;
}
.error
{
	 color: #b94a48;
}
</style>
<?php
$this->load->view("common/header.php");
$this->load->view("common/leftbar.php");
?>
<div class="content-wrapper">
           <!-- Content Header (Page header) -->
			   <section class="content-header">
                    <h1>
					    Create Quotation
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Create Quotation</li>
                    </ol>
                </section>

				<section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                             <h2 class="page-header" align="right">
                             	<!--<?php
                                if(! empty($page))
								{
									?>
                                    <a href="<?php echo base_url().'product/manageProduct/?page='.$page?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i></a>
                                    <?php
								}
								else
								{
									?>
                                    <a href="<?php echo base_url().'product/manageProduct'?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i></a>
                                    <?php
								}
								?>-->
                             </h2>
                            
							<form role="form" name="frm" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post" action="<?php echo current_url().$url?>"> 
							  <div class="box box-primary">
									  <div class="box-body">
											   <div class="form-group">
												  <label for="inputEmail3" class="col-sm-3 control-label">Quotation Code:<span class="text-error"><b>*</b></span></label>
												  <?php echo form_error('qno' ,'<div class="text-error">','</div>'); ?>
												  <div class="col-sm-4">
													  <input type="text" name="qno" id="qno" class="form-control" placeholder="Enter Quotation Number" style="text-transform:uppercase"  value="<?php if($qno!=''){ echo set_value('qno',$qno); }else{ echo 'Q-'.generateQuotationCode(); }?>" readonly="readonly" required >
												  </div>
											   </div>
											   <div class="row">
												  <div class="form-group col-md-12">
													   <label for="exampleInputEmail1" class="col-sm-3 control-label">Customer Name:<span class="text-error"><b>*</b></span></label>
													   <div class="col-sm-4">
															  <input type="hidden" class="bigdrop" name="user_id" id="usersearch" style="width:260px" value="<?PHP echo $user_id;?>" required />
													   </div>
												  </div>
											   </div>
											   <div class="form-group">
												  <label for="inputEmail3" class="col-sm-3 control-label">Customer Bill Type:<span class="text-error"><b>*</b></span></label>
												  <?php echo form_error('cbilltype' ,'<div class="text-error">','</div>'); ?>
												  <div class="col-sm-4">
													  <input type="text" name="cbilltype" id="cbilltype" class="form-control" placeholder="Enter Customer Bill Type" style="text-transform:uppercase" value="<?php echo set_value('cbilltype',$cbilltype);?>" readonly="readonly" required >
												  </div>
											   </div>
											   <div class="form-group">
												  <label for="inputEmail3" class="col-sm-3 control-label">Quotation LPO Number:</label>
												  <?php echo form_error('qlponumber' ,'<div class="text-error">','</div>'); ?>
												  <div class="col-sm-4">
													  <input type="text" name="qlponumber" id="qlponumber" class="form-control" placeholder="Enter Quotation LPO Number" style="text-transform:uppercase" value="<?php echo set_value('qlponumber',$qlponumber);?>" required>
												  </div>
											   </div>
											   <div class="form-group">
												  <label for="inputEmail3" class="col-sm-3 control-label">Discount:</label>
												  <?php echo form_error('qdiscount' ,'<div class="text-error">','</div>'); ?>
												  <div class="col-sm-4">
													  <input type="number" name="qdiscount" id="qdiscount" class="form-control" placeholder="Enter Quotation Discount" style="text-transform:uppercase" value="<?php echo set_value('qdiscount',$qdiscount);?>">
												  </div>
											   </div>
									   </div>
							  </div><!-- /.box -->
							  
							  <div class="box box-primary">
								   <div class="col-md-12">
										<!--
										<h2 class="page-header" align="right">
											 <a href="javascript:void(0);" class="btn btn-success" onclick="addNewCart();"><i class="fa fa-fw fa-cart-plus"></i></a>
										</h2>
										-->
										
								   </div>
								   <div class="row">
										
										<div id="errorMessage" class="col-md-12"></div>
								   </div>
								   
								   <table class="table table-hover table-bordered table-striped">
										<thead>
											 <tr>
												  <td width="25%"><b>Part Number</b></td>
												  <td><b>Description</b></td>
												  <td><b>Left Qty</b></td>
												  <td><b>Right Qty</b></td>
												  <td><b>Qty</b></td>
												  <td><b>UnitPrice</b></td>
												  <td><b>Amount</b></td>
												  <td><b>Action</b></td>
											 </tr>
										</thead>
										<tbody id="addCartData" class="addCartData">
											 
											 <?php
											 if(!empty($quotation_records)){
												  $i = 1;
												  foreach($quotation_records as $records){
											 ?>
												  <tr id="cardinsert_<?php echo $i;?>">
													   <td><input type="hidden" class="bigdrop" name="cart_id[]" id="productsearch_<?php echo $i;?>" onkeyup="getProductCode('<?php echo $i;?>')" style="width:260px" value="<?php echo $records['qlProductId'];?>" required /></td>
													   <td><input type="text" name="desc[]" id="desc_<?php echo $i;?>" class="form-control" placeholder="Description" style="text-transform:uppercase" value="<?php echo getDescriptionByProductId($records['qlProductId']);?>" ></td>
													   <td><input type="number" name="lqty[]" id="lqty_<?php echo $i;?>" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="Left Quantity" style="text-transform:uppercase" value="<?php echo $records['qlLeftQuantity'];?>" ></td>
													   <td><input type="number" name="rqty[]" id="rqty_<?php echo $i;?>" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="Right Quantity" style="text-transform:uppercase" value="<?php echo $records['qlRightQuantity'];?>" ></td>
													   <td><input type="number" name="qty[]" id="qty_<?php echo $i;?>" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="Qunatity" style="text-transform:uppercase" value="<?php echo $records['qlQuantity'];?>" ></td>
													   <td><input type="number" name="uprice[]" id="uprice_<?php echo $i;?>" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 46 && event.charCode <= 57" class="form-control" placeholder="Unit Price" onblur="setTotalOfProduct('<?php echo $i;?>');" style="text-transform:uppercase" value="<?php echo $records['qlUnitPrice'];?>"></td>
													   <input type="hidden" name="huprice[]" id="huprice_<?php echo $i;?>" class="form-control" value="" style="text-transform:uppercase">
													   <td><input type="number" name="tamount[]" id="tamount_<?php echo $i;?>" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 46 && event.charCode <= 57" class="form-control" placeholder="0.00" style="text-transform:uppercase" value="<?php echo $records['qlTotalPrice'];?>"></td>
													   <td><a href="javascript:void(0);" onClick="removeRecord('<?php echo $i;?>');" class="btn btn-default btn-circle" id="delete"><i class="fa fa-times"></i></a></td>
												  </tr>
											 <?php
												  $i++;
												  }
											 }
											 ?>
											 
										</tbody>
								   </table>
								   <div class="box-footer">
										<input type="hidden" name="quotation_id" id="quotation_id"  value="<?php echo $quotation_id;?>" />
										<input type="submit" name="save" id="save" value="Save" onclick="return checkValidation();" class="btn btn-primary">
										<a href="<?php echo base_url().'quotation/manageQuotation'?>" class="btn btn-primary">Cancel</a>
								   </div>
							  </div>
							  
						    </form>

                        </div><!--/.col (left) -->
                        <!-- right column -->
                        
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
        </div>
<?php
$this->load->view("common/footer.php");
?>
<script type="text/javascript" language="javascript">
$(document).ready(function()
{
	 var quotationRecords = '<?php echo $quotation_count;?>';
	
	 if (quotationRecords!='') {
		  var k=0;
		  //alert(quotationRecords);
		  
		  for (i=1;i<=quotationRecords;i++) {
					//alert(i);
					$('#productsearch_'+i).select2({
								placeholder: 'Search For a Product',
								closeOnSelect: true,
								minimumInputLength: 1,
								formatResult: formatProduct,
								formatSelection: formatSelectProduct,
								ajax: {
										url: "<?php echo base_url() ?>quotation/getProductByAjax",
										dataType: 'json',
										quietMillis: 100,
										data : function(term, page){
											return {
												term: term, //search term
												page_limit: 0 // page size
											};
										},
										results : function(data, page){
											return { results: data.results };
										}
								},
								initSelection: function(element, callback) {
									return $.getJSON("<?php echo base_url() ?>quotation/getProductByAjax/" + (element.val()), null, function(data) {
											//alert(data.results[0].id);
											return callback(data.results[0]);
									});
								},
					}).on('click', function(e) {
					   //alert(e);
					   console.log(e.currentTarget.id);
					   var TargetId = e.currentTarget.id;
					   var TargetIds = TargetId.split("_");  
					  var value = e.currentTarget.value;
					  //alert(i+' '+value);
					  //console.log(value);
					  $.ajax({
								url: "<?php echo base_url() ?>quotation/getProductSalesPrice",
								dataType: 'json',
								type: "POST",
								data : {'product_id':value},
								success: function (data) {
										
										$("#uprice_"+TargetIds[1]).val('');
										$("#huprice_"+TargetIds[1]).val('');
										$("#prdname_"+TargetIds[1]).val('');
										$("#desc_"+TargetIds[1]).val('');
										$("#lqty_"+TargetIds[1]).val('');
										$("#rqty_"+TargetIds[1]).val('');
										$("#qty_"+TargetIds[1]).val('');
										$("#tamount_"+TargetIds[1]).val('');
								   
									    $("#uprice_"+TargetIds[1]).val(data.msg);
										$("#huprice_"+TargetIds[1]).val(data.msg1);
										$("#prdname_"+TargetIds[1]).val(data.prdName);
										$("#desc_"+TargetIds[1]).val(data.desc);
										$("#lqty_"+TargetIds[1]).focus();
								}
					  });
					});
					k++;
		  }
	 
		  
		  
     }
	 
	 $("#frm").validate(
	 {
		rules:
		{
			pcode:"required",
			pname:"required",
			
			
		},
		messages:
		{
		    pcode:"<div class='text-error'>Please Enter Product Code</div>",
			pname:"<div class='text-error'>Please Enter Product Name</div>",
		}
	 });
});

$(document).keydown(function(e){
    //alert(e.keyCode);
	if (e.shiftKey && e.keyCode==187) {
		  addNewCart();
	}
});

var quotationId = '<?php echo $quotation_id;?>';
function checkValidation() {

	 var counts = $('#addCartData').children('tr').length;
	 var error = false;
	 var msg = '';
	 var salesValue = '';
	 var hiddenUnitPrice = '';
	 var productName = '';
	 
	 for (i=1;i<=counts;i++) {
		  
		  salesValue =0;
		  hiddenUnitPrice = 0;
		  productName = 0;
		  
		  salesValue = parseFloat($('#uprice_'+i).val());
		  hiddenUnitPrice = parseFloat($('#huprice_'+i).val());
		  productName = $("#prdname_"+i).val();
		  
		  //alert(salesValue+' '+hiddenUnitPrice+' '+productName);
		  
		  if(salesValue<hiddenUnitPrice){
			   
			   //alert('In If Condition');
			   
			   error = true;
			   msg += '<div id="error" class="alert alert-danger fade in"><button data-dismiss="alert" class="close" type="button">x</button><h4>Please Enter Equal or Greater Unit Price In '+productName+'.</h4></div> \n';
			   
          }
		  
	 }
	 
	 if (error==true) {
		  $('#errorMessage').html(msg);
		  return false;
     }else{
		  return true;
	 }

}

function getCutomerBillType(customerId) {
    $.ajax(
	{
		type: "POST",
		url: '<?php echo base_url()?>quotation/getCutomerBillType/',
		data: {'customerId':customerId},
		dataType : 'json',
		success: function(data)
		{
			$("#cbilltype").val(data.msg);
		}
	});
}
function format(results) 
{
	return  " <strong>" + results.code + "</strong>";
}
function formatSelect(results) {
    
	getCutomerBillType(results.id);
	return  " <strong>" + results.code + "</strong>";
}

$('#usersearch').select2({
			placeholder: 'Search For a Customer',
			closeOnSelect: true,
			minimumInputLength: 1,
			formatResult: format,
			formatSelection: formatSelect,
			ajax: {
                    url: "<?php echo base_url() ?>quotation/getCustomerByAjax",
                    dataType: 'json',
                    quietMillis: 100,
                    data : function(term, page){
                        return {
                            term: term, //search term
                            page_limit: 0 // page size
                        };
                    },
                    results : function(data, page){
                        return { results: data.results };
                    }
			},
			initSelection: function(element, callback) {
				return $.getJSON("<?php echo base_url() ?>quotation/getCustomerByAjax/" + (element.val()), null, function(data) {
						//alert(data.results[0].id);
						return callback(data.results[0]);
				});
			},
});
function formatProduct(results) {
	return  " <strong>" + results.code + "</strong>";
}
function formatSelectProduct(results) {
	return  " <strong>" + results.code + "</strong>";
}

function addNewCart() {
     var count = $('#addCartData').children('tr').length;
	
	 var data = '';
	 var total;
	
     total = count + 1;
	
	 data = '<tr id="cardinsert_'+total+'">';
	 data += '<td><input type="hidden" class="bigdrop" name="cart_id[]" id="productsearch_'+total+'" onkeyup="getProductCode('+total+')" style="width:260px" value="" required /></td>';
	 data += '<input type="hidden" name="prdname[]" id="prdname_'+total+'" class="form-control" value="" style="text-transform:uppercase">';
	 data += '<td><input type="text" name="desc[]" id="desc_'+total+'" class="form-control" placeholder="Description" style="text-transform:uppercase" ></td>';
	 data += '<td><input type="number" name="lqty[]" id="lqty_'+total+'" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="Left Quantity" style="text-transform:uppercase" ></td>';
	 data += '<td><input type="number" name="rqty[]" id="rqty_'+total+'" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="Right Quantity" style="text-transform:uppercase" ></td>';
	 data += '<td><input type="number" name="qty[]" id="qty_'+total+'" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" class="form-control" placeholder="Qunatity" style="text-transform:uppercase" ></td>';
	 data += '<td><input type="number" name="uprice[]" id="uprice_'+total+'" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null :  event.charCode >= 46 && event.charCode <= 57" class="form-control" placeholder="Unit Price" onblur="setTotalOfProduct('+total+');" value="" style="text-transform:uppercase"></td>';
	 data += '<input type="hidden" name="huprice[]" id="huprice_'+total+'" class="form-control" value="" style="text-transform:uppercase">';
	 data += '<td><input type="number" name="tamount[]" id="tamount_'+total+'" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 46 && event.charCode <= 57" class="form-control" placeholder="0.00" style="text-transform:uppercase"></td>';
	 data += '<td><a href="javascript:void(0);" onClick="removeRecord('+total+');" class="btn btn-default btn-circle" id="delete"><i class="fa fa-times"></i></a></td>';
	 data += '</tr>';
	
	 $('#addCartData').append(data);
	
	 $('#productsearch_'+total).select2({
					placeholder: 'Search For a Product',
					closeOnSelect: true,
					minimumInputLength: 1,
					formatResult: formatProduct,
					formatSelection: formatSelectProduct,
					ajax: {
							url: "<?php echo base_url() ?>quotation/getProductByAjax",
							dataType: 'json',
							quietMillis: 100,
							data : function(term, page){
								return {
									term: term, //search term
									page_limit: 0 // page size
								};
							},
							results : function(data, page){
								return { results: data.results };
							}
					},
					initSelection: function(element, callback) {
						return $.getJSON("<?php echo base_url() ?>quotation/getProductByAjax/" + (element.val()), null, function(data) {
								//alert(data.results[0].id);
								return callback(data.results[0]);
						});
					},
	 }).on('click', function(e) {
		 
		  var value = $('#productsearch_'+total).val();
		  $.ajax({
					url: "<?php echo base_url() ?>quotation/getProductSalesPrice",
					dataType: 'json',
					type: "POST",
					data : {'product_id':value},
					success: function (data) {
						 $("#uprice_"+total).val('');
						 $("#huprice_"+total).val('');
						 $("#prdname_"+total).val('');
						 $("#desc_"+total).val('');
						 $("#lqty_"+total).val('');
						 $("#rqty_"+total).val('');
						 $("#qty_"+total).val('');
						 $("#tamount_"+total).val('');
						 $("#uprice_"+total).val(data.msg);
						 $("#huprice_"+total).val(data.msg1);
						 $("#prdname_"+total).val(data.prdName);
						 $("#desc_"+total).val(data.desc);
						 $("#lqty_"+total).focus();
					}
		  });
	 });
}

function removeRecord(id) {
    $("#cardinsert_"+id).remove();
}

function setTotalOfProduct(id) {
    
	var quantity = $("#qty_"+id).val();
	var unitprice = $("#uprice_"+id).val();
	var totalamount = quantity*unitprice;
	$("#tamount_"+id).val(totalamount);
	
}
</script>