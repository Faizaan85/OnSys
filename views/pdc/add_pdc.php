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
						 <?php
						 if($pdc_id>0){
						 ?>
						 Edit PDC
						 <?php
						 }else{
						 ?>
						 Add PDC
						 <?php
						 }
						 ?>
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                         <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li class="active">
							   <?php
								   if($pdc_id>0){
								   ?>
								   Edit PDC
								   <?php
								   }else{
								   ?>
								   Add PDC
								   <?php
								   }
							  ?>
						 </li>
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
												  <label for="inputEmail3" class="col-sm-3 control-label">PDC Receipt No:<span class="text-error"><b>*</b></span></label>
												  <?php echo form_error('qno' ,'<div class="text-error">','</div>'); ?>
												  <div class="col-sm-4">
													  <input type="text" name="qno" id="qno" class="form-control" placeholder="Enter Quotation Number" style="text-transform:uppercase"  value="<?php if($qno!=''){ echo set_value('qno',$qno); }else{ echo 'P-'.generateQuotationCode(); }?>" readonly="readonly" required >
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
												  <label for="inputEmail3" class="col-sm-3 control-label">PDC Bill Type:<span class="text-error"><b>*</b></span></label>
												  <?php echo form_error('cbilltype' ,'<div class="text-error">','</div>'); ?>
												  <div class="col-sm-4">
													  <select name="cbilltype" id="cbilltype" class="form-control" onchange="checkValue(this.value);">
															<option value="">Select Payment Type</option>
															<option value="cash" <?php if($cbilltype=="cash"){ ?> selected="selected" <?php } ?> >Cash</option>
															<option value="cheque" <?php if($cbilltype=="cheque"){ ?> selected="selected" <?php } ?>>Cheque</option>
													  </select>
												  </div>
											   </div>
											   <div id="chequeId" <?php if($pdc_id>0 && $cbilltype=='cheque'){ ?><?php }else{ ?> style="display:none;" <?php } ?>>
												  <div class="form-group" >
													   <label for="inputEmail3" class="col-sm-3 control-label">PDC Cheque Number:</label>
													   <?php echo form_error('pchequenumber' ,'<div class="text-error">','</div>'); ?>
													   <div class="col-sm-4">
														   <input type="text" name="pchequenumber" id="pchequenumber" class="form-control" placeholder="Enter PDC Cheque Number" style="text-transform:uppercase" value="<?php echo set_value('pchequenumber',$pchequenumber);?>" >
													   </div>
												  </div>
												  <div class="form-group">
													   <label for="inputEmail3" class="col-sm-3 control-label">Bank Name:</label>
													   <?php echo form_error('pbankname' ,'<div class="text-error">','</div>'); ?>
													   <div class="col-sm-4">
														   <input type="text" name="pbankname" id="pbankname" class="form-control" placeholder="Enter Bank Name" style="text-transform:uppercase" value="<?php echo set_value('pbankname',$pbankname);?>">
													   </div>
												  </div>
											   </div>
											   
											   
											   <div class="form-group">
												  <label for="inputEmail3" class="col-sm-3 control-label">Amount:</label>
												  <?php echo form_error('pbankname' ,'<div class="text-error">','</div>'); ?>
												  <div class="col-sm-4">
													  <input type="number" name="pamount" id="pamount" class="form-control" placeholder="Enter PDC Amount" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null :  event.charCode >= 46 && event.charCode <= 57" style="text-transform:uppercase" value="<?php echo set_value('pamount',$pamount);?>">
												  </div>
											   </div>
											   
											   <div class="form-group">
												  <label for="inputEmail3" class="col-sm-3 control-label">PDC Date:</label>
												  <?php echo form_error('pdate' ,'<div class="text-error">','</div>'); ?>
												  <div class="col-sm-4">
													  <input type="text" name="pdate" id="datemask" class="form-control"  value="<?php echo set_value('pdate',$pdate);?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
												  </div>
											   </div>
											   
									   </div>
								       <div class="box-footer">
										  <input type="hidden" name="pdc_id" id="pdc_id"  value="<?php echo $pdc_id;?>" />
										  <input type="submit" name="save" id="save" value="Save" class="btn btn-primary">
										  <a href="<?php echo base_url().'pdc/managePDC'?>" class="btn btn-primary">Cancel</a>
								       </div>
							  </div><!-- /.box -->
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
$(function () {
		  
	 //Datemask dd/mm/yyyy
	 $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
	 //Datemask2 mm/dd/yyyy
	 $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
	 //Money Euro
	 $("[data-mask]").inputmask();
		  
});
$(document).ready(function()
{
	 //$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
});


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
function checkValue(value) {
    if (value=='cash') {
		  $('#chequeId').css('display','none');
    }else{
		  $('#chequeId').css('display','');
	}
}
function format(results) 
{
	return  " <strong>" + results.code + "</strong>";
}
function formatSelect(results) {
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
</script>