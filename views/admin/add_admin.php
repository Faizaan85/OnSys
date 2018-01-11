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
						if(!empty($admin_id)){
					    ?>
						Edit Admin
						<?php
						}else{
					    ?>
						Add Admin
						<?php
						}
						?>
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Add Admin</li>
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
                                    <a href="<?php echo base_url().'admin/manageAdmin/?page='.$page?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i></a>
                                    <?php
								}
								else
								{
									?>
                                    <a href="<?php echo base_url().'admin/manageAdmin'?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i></a>
                                    <?php
								}
								?>
                             </h2>
                             
                            <div class="box box-primary">
                                
                                <!-- form start -->
                                <form role="form" name="frm" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post" action="<?php echo current_url().$url?>">
                                	<div class="box-body">
                                             <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">First Name:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('fname' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name"  value="<?php echo set_value('fname',$fname);?>" required autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Last Name:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('lname' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Last Name"  value="<?php echo set_value('lname',$lname);?>" required autofocus>
                                                 </div>
                                             </div>
											 
											 <div class="form-group">
                                                <label for="inputEmail" class="col-sm-3 control-label">Admin Role:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('arole' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                 	<select name="arole" id="arole" class="form-control">
															<option value="">Please Select Value</option>
															<?php 
															if($arole == "admin")
															{
															?>
																<option value="admin" selected>Admin</option>
																<option value="sales">Sales</option>
																<option value="operator">Operator</option>
															<?php
															}
															if($arole=="sales"){
															?>
															    <option value="admin">Admin</option>
																<option value="sales" selected>Sales</option>
																<option value="operator">Operator</option>
															<?php
															}if($arole=="operator"){
															?>
															    <option value="admin">Admin</option>
																<option value="sales">Sales</option>
																<option value="operator" selected>Operator</option>
															<?php
															}
															else
															{
																?>
																<option value="admin">Admin</option>
																<option value="sales">Sales</option>
																<option value="operator">Operator</option>
																<?php
															}
															?>
															
															
													</select>
                                                 </div>
                                             </div>
											 
                                             <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Email Id:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('aemail' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                 	<input type="text" name="aemail" id="aemail" class="form-control" placeholder="Enter EmailId" value="<?php echo set_value('aemail',$aemail);?>" <?php if(!empty($aemail) && $admin_id!=0){?> readonly <?php } ?> required focus>
                                                 </div>
                                             </div>
											 
											 <div class="form-group" style="<?php if(!empty($admin_id)){ ?>display:none; <?php } ?>">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Password:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('apassword' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                 	<input type="password" name="apassword" id="apassword" class="form-control" placeholder="Enter Password" value="<?php echo set_value('apassword',$apassword);?>" <?php if(!empty($apassword)){?> readonly <?php } ?> required focus>
                                                 </div>
                                             </div>
											 
											 
											 <div class="form-group" style="<?php if(!empty($admin_id)){ ?>display:none; <?php } ?>">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('acpassword' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                 	<input type="password" name="acpassword" id="acpassword" class="form-control" placeholder="Enter Confirm Password" value="<?php echo set_value('acpassword',$acpassword);?>" <?php if(!empty($acpassword)){?> readonly <?php } ?> required focus>
                                                 </div>
                                             </div>
											 
											 
										     <div class="form-group">
                                                <label for="inputEmail" class="col-sm-3 control-label">Admin Status:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('astatus' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                 	<select name="astatus" id="astatus" class="form-control">
															<option value="">Please Select Value</option>
															<?php 
															if($astatus==0){
															?>
																<option value="1" >Active</option>
																<option value="0" selected>Inactive</option>
															<?php
															}
															if($astatus==1){
															?>
															    <option value="1" selected>Active</option>
																<option value="0">Inactive</option>
															<?php
															}
															else
															{
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
											    <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $admin_id;?>" />
                                                <input type="submit" name="save" id="save" value="Save" class="btn btn-primary">
												<a href="<?php echo base_url().'admin/manageAdmin'?>" class="btn btn-primary">Cancel</a>
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
			fname:"required",
			lname:"required",
			aemail:{
			   required: true,
			   email: true
			},
			apassword:{
					required:true,
					minlength:6,
			},
			acpassword:{
					required:true,
					equalTo: "#apassword"
			},
			arole: "required",
			astatus: "required"
		},
		messages:
		{
		    fname:"<div class='text-error'>Please Enter First Name</div>",
			lname:"<div class='text-error'>Please Enter Last Name</div>",
			aemail:"<div class='text-error'>Please Enter Valid Email Address</div>",
			apassword:"<div class='text-error'>Please Enter Password</div>",
			acpassword:"<div class='text-error'>Please Enter Correct Password</div>",
			arole:"<div class='text-error'>Please Select Admin Role</div>",
			astatus:"<div class='text-error'>Please Select Admin Statu </div>"
		}
	});
});
</script>