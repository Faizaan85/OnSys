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
                        Edit Student
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit Student</li>
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
                                    <a href="<?php echo base_url().'student/dashboard/?page='.$page?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i></a>
                                    <?php
								}
								else
								{
									?>
                                    <a href="<?php echo base_url().'student/dashboard/'?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i></a>
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
                                                <label for="inputEmail3" class="col-sm-3 control-label">Email Id:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('aemail' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                 	<input type="text" name="aemail" id="aemail" class="form-control" placeholder="Enter EmailId" value="<?php echo set_value('aemail',$aemail);?>" <?php if(!empty($aemail) && $user_id!=0){?> readonly <?php } ?> required focus>
                                                 </div>
                                             </div>
											 
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Gender:</label>
                                                 <?php echo form_error('agender' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                 	<input type="radio" name="agender" class="form-control" value="m" <?php if($agender=='m'){?> checked <?php }?>> Male
													<input type="radio" name="agender" class="form-control" value="f" <?php if($agender=='f'){?> checked <?php }?>> Female
                                                 </div>
                                             </div>
											 
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Birthdate:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('abirthdate' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                 	<input type="text" name="abirthdate" id="abirthdate" class="form-control" placeholder="Enter BirthDate DD/MM/YYYY" value="<?php echo set_value('abirthdate',$abirthdate);?>" <?php if(!empty($abirthdate)) {?> readonly disabled <?php }?> required focus>
                                                 </div>
                                             </div>
											 
											 <div class="form-group">
												  <label for="inputEmail" class="col-sm-3 control-label">Profile Image:<span class="text-error"><b>*</b></span></label>
												  <div class="col-sm-4">
													   <input type="file" name="aprofileImage">
													   <br />
													   <?php
															if(!empty($aprofileImage))
															{
													   ?>
															    <div class="col-md-4">
																	  <div clsaa="col-md-2">
																		   <input type="hidden" name="pro_image" value="<?php echo $aprofileImage ?>" />
																		   <?php
																		   if(strstr($aprofileImage, "http://")){
																		   ?>
																		   <img src="<?php echo $aprofileImage ?>" class="img-rectangle" height="150" width="150" />
																		   <?php
																		   }else{
																		   ?>
																		   <img src="<?php echo $this->config->item('base_url_site');?>uploads/user/<?php echo $aprofileImage ?>" class="img-rectangle" height="150" width="150" />
																		   <?php
																		   }
																		   ?>
																	  </div>
																	  <a href="javascript:void(0)" onclick="removeImage('<?php echo $user_id;?>','<?php echo $aprofileImage;?>');" id="rmvLink">Remove Image</a>
																	  <div class="col-md-2">
																		   <a href="javascript:void(0)" onclick="sendReport('<?php echo $user_id;?>');" class="btn btn-info">Report</a>
																	  </div>
																	   
																</div>
																 
																
													   <?php
															}
													   ?>
												  </div>
											 </div>					
											
											
                                             <div class="box-footer">
											    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" />
                                                <input type="submit" name="save" id="save" value="Save" class="btn btn-primary">
												<a href="<?php echo base_url().'student/dashboard/'?>" class="btn btn-primary">Cancel</a>
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
			}
		},
		messages:
		{
		    fname:"<div class='text-error'>Please Enter First Name</div>",
			lname:"<div class='text-error'>Please Enter Last Name</div>",
			aemail:"<div class='text-error'>Please Enter Valid Email Address</div>",
			apassword:"<div class='text-error'>Please Enter Password</div>",
			acpassword:"<div class='text-error'>Please Enter Correct Password</div>"
		}
	});
	
	$('#datepicker').datepicker({
      autoclose: true
    });
});

function removeImage(userId,imageName) {
    //alert(userId + ' ' +imageName);
	
	$.ajax({
			type:'POST',
			url:"<?php echo site_url('student/removeImage');?>",
			data:'action=removeImage&user_id='+userId+'&imagename='+imageName,
		    success: function(data)
			{
			   $("#pro_image").val('');
			   $('img').hide();
			   $('#rmvLink').hide();					
			}
	 });
}


</script>