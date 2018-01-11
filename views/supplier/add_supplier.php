<style>
.text-error
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
						if(!empty($customer_id)){
					    ?>
						Edit Supplier
						<?php
						}else{
					    ?>
						Add Supplier
						<?php
						}
						?>
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php
						if(!empty($customer_id)){
					    ?>
						Edit Supplier
						<?php
						}else{
					    ?>
						Add Supplier
						<?php
						}
						?></li>
                    </ol>
                </section>

				<section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                             <h2 class="page-header" align="right">
                             	<?php
                                if(! empty($page))
								{
									?>
                                    <a href="<?php echo base_url().'supplier/manageSupplier/?page='.$page?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i></a>
                                    <?php
								}
								else
								{
									?>
                                    <a href="<?php echo base_url().'supplier/manageSupplier'?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i></a>
                                    <?php
								}
								?>
                             </h2>
                             
                            <div class="box box-primary">
                                
                                <!-- form start -->
                                <form role="form" name="frm" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post" action="<?php echo current_url().$url?>">
                                	<div class="box-body">
                                             <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Supplier Code:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('ccode' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="ccode" id="ccode" style="text-transform:uppercase" class="form-control" placeholder="Enter Supplier Code"  value="<?php echo set_value('ccode',$ccode);?>" <?php if($ccode!='' && $supplier_id!=''){ ?> readonly="readonly" <?php } ?> required autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Company Name:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('cname' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="cname" id="cname" style="text-transform:uppercase" class="form-control" placeholder="Enter Company Name"  value="<?php echo set_value('cname',$cname);?>" required autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">EmailId:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('cemail' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="cemail" id="cemail" style="text-transform:uppercase" class="form-control" placeholder="Enter Supplier EmailId"  value="<?php echo set_value('cemail',$cemail);?>" required autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Address:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('caddress' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
													   <textarea name="caddress" id="caddress" style="text-transform:uppercase" cols="53" rows="6"><?php echo set_value('caddress',$caddress);?></textarea>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Contact Person Name:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('cperson' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="cperson" id="cperson" style="text-transform:uppercase" class="form-control" placeholder="Enter Contact Person Name"  value="<?php echo set_value('cperson',$cperson);?>" required autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Phone Number1:</label>
                                                 <?php echo form_error('cphone' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="cphone" id="cphone" style="text-transform:uppercase" class="form-control" placeholder="Enter Phone Number"  value="<?php echo set_value('cphone',$cphone);?>" autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Phone Number2:</label>
                                                 <?php echo form_error('cphone' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="cphone1" id="cphone1" style="text-transform:uppercase" class="form-control" placeholder="Enter Phone Number"  value="<?php echo set_value('cphone1',$cphone1);?>" autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Mobile Number1:</label>
                                                 <?php echo form_error('cmobile' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="cmobile" id="cmobile" style="text-transform:uppercase" class="form-control" placeholder="Enter Mobile Number"  value="<?php echo set_value('cmobile',$cmobile);?>"  autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Mobile Number2:</label>
                                                 <?php echo form_error('cmobile1' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="cmobile1" id="cmobile1" style="text-transform:uppercase" class="form-control" placeholder="Enter Mobile Number"  value="<?php echo set_value('cmobile1',$cmobile1);?>"  autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Fax Number:</label>
                                                 <?php echo form_error('cfax' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="cfax" id="cfax" style="text-transform:uppercase" class="form-control" placeholder="Enter Fax Number"  value="<?php echo set_value('cfax',$cfax);?>"  autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail" class="col-sm-3 control-label">Bill Type:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('cbilltype' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                 	<select name="cbilltype" id="cbilltype" class="form-control">
													   <option value="">Please Select Value</option>
													   <option value="NET 30" <?php if($cbilltype=='NET 30'){?> selected <?php } ?>>NET 30</option>
													   <option value="NET 60" <?php if($cbilltype=='NET 60'){?> selected <?php } ?>>NET 60</option>
													   <option value="NET 90" <?php if($cbilltype=='NET 90'){?> selected <?php } ?>>NET 90</option>
													   <option value="CASH" <?php if($cbilltype=='CASH'){?> selected <?php } ?>>CASH</option>
												  </select>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Credit Limit:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('climit' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="climit" id="climit" class="form-control" placeholder="Enter Supplier Credit Limit"  value="<?php echo set_value('climit',$climit);?>"  <?php if(!empty($climit)){ ?> readonly="readonly" <?php } ?>  autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Credit Available:</label>
                                                 <?php echo form_error('cavailable' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="cavailable" id="cavailable" class="form-control"  value="<?php echo set_value('cavailable',$cavailable);?>" readonly="readonly" autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Supplier Balance:</label>
                                                 <?php echo form_error('cbalance' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="cbalance" id="cbalance" class="form-control" placeholder="Enter Supplier Balance"  value="<?php echo set_value('cbalance',$cbalance);?>" <?php if(!empty($cbalance)){ ?> readonly="readonly" <?php } ?> autofocus>
                                                 </div>
                                             </div>			 
											 
											 <div class="form-group">
                                                <label for="inputEmail" class="col-sm-3 control-label">Supplier Status:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('cstatus' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                 	<select name="cstatus" id="cstatus" class="form-control">
															<option value="">Please Select Value</option>
															<?php 
															if($cstatus==0){
															?>
																<option value="1" >Active</option>
																<option value="0" selected>Inactive</option>
															<?php
															}
															if($cstatus==1){
															?>
																<option value="1" selected>Active</option>
																<option value="0">Inactive</option>
															<?php
															}
															if($cstatus==' '){
																?>
																<option value="1">Active</option>
																<option value="0">Inactive</option>
																<?php
															}
															?>
															
															
													</select>
                                                 </div>
                                             </div>
											
											
											
                                            <div class="box-footer">
												  <input type="hidden" name="supplier_id" id="supplier_id" value="<?php echo $supplier_id;?>" />
                                                  <input type="submit" name="save" id="save" value="Save" class="btn btn-primary">
												  <a href="<?php echo base_url().'supplier/manageSupplier'?>" class="btn btn-primary">Cancel</a>
                                            </div>
                                     </div>
                                </form>
                            </div><!-- /.box -->

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
	$("#frm").validate(
	{
		rules:
		{
			ccode:"required",
			cname:"required",
			cemail:{
			   required: true,
			   email: true
			},
			cperson: "required",
			cbilltype: "required",
			climit: "required",
			caddress: "required",
			cstatus: "required"
		},
		messages:
		{
	        ccode:"<div class='text-error'>Please Enter Supplier Code</div>",
			cname:"<div class='text-error'>Please Enter Company Name</div>",
			cemail:"<div class='text-error'>Please Enter Valid Email Address</div>",
			cperson:"<div class='text-error'>Please Enter Contact Person Name</div>",
			cbilltype:"<div class='text-error'>Please Select Supplier Bill Type</div>",
			caddress:"<div class='text-error'>Please Enter Supplier Address</div>",
			climit:"<div class='text-error'>Please Enter Supplier Limit</div>",
			cstatus:"<div class='text-error'>Please Select Supplier Status </div>"
		}
	});
});
</script>