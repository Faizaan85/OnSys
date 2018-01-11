<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Music Teacher | Register</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url() ?>assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url() ?>assets/js/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<!-- jQuery 2.0.2 -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-2.0.3.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/plugins/daterangepicker/daterangepicker.js"></script>
		<!-- bootstrap datepicker -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/datepicker/bootstrap-datepicker.js"></script>

		
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url() ?>assets/js/plugins/iCheck/icheck.min.js"></script>
		<script>
		  $(function () {
			$('input').iCheck({
			  checkboxClass: 'icheckbox_square-blue',
			  radioClass: 'iradio_square-blue',
			  increaseArea: '20%' // optional
			});
		  });
		</script>
        <script type="text/javascript" language="javascript">
		$(document).ready(function()
		{
				$("#lgnForm").validate(
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
						adate: "required"
					},
					messages:
					{
						fname:"<div class='text-error'>Please Enter First Name</div>",
						lname:"<div class='text-error'>Please Enter Last Name</div>",
						aemail:"<div class='text-error'>Please Enter Valid Email Address</div>",
						apassword:"<div class='text-error'>Please Enter Password</div>",
						acpassword:"<div class='text-error'>Please Enter Correct Password</div>",
						adate: "<div class='text-error'>Please Select Birthdate </div>"
					}
				});
				
				
		});
		$(function () {
			//Date picker
			$('#datepicker').datepicker({
			  format : "mm-dd-yyyy",
			  autoclose: true
			});
		});
		</script>
        <style type="text/css">
			#lgnForm label.error
			{
				margin-bottom:10px;
				width: 250%;
				display: inline;
				color:#b94a48;
			}
			.error
			{
				color:#b94a48;
			}
		</style>
    </head>
    <body class="hold-transition login-page">
		
        
                
        <div class="login-box">
			<div class="login-logo">
				<a href="<?php echo base_url().'student/';?>"><b>Music</b>Teacher</a>
		    </div>
        	<div class="login-box-body"> 
            <p class="login-box-msg"><b>Register</b></p>
            <?php echo form_open(base_url().'student/register','id="lgnForm"');?> 
                <div>
                	<?php if($this->session->flashdata('message'))
						{
				  	?>
				  			<div class="alert alert-success alert-dismissable" align="center">
									<i class="fa fa-check"></i>
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<b><?php echo $this->session->flashdata('message')?></b>
							</div>
					<?php 
						} ?>
					
							
					<?php if($this->session->flashdata('errormessage'))
						{
				  	?>
				  			<div class="alert alert-danger alert-dismissable" align="center">
									<i class="fa fa-check"></i>
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<b><?php echo $this->session->flashdata('errormessage')?></b>
							</div>
					<?php 
						} ?>
				
					
					<div class="form-group has-feedback">
						 <?php echo form_error('aemail' ,'<div class="text-error">','</div>'); ?>
							<input type="text" name="aemail" id="aemail" class="form-control" placeholder="Enter EmailId" value="<?php echo set_value('aemail',$aemail);?>" required focus>
					</div>
					 
					<div class="form-group has-feedback">
						<?php echo form_error('apassword' ,'<div class="text-error">','</div>'); ?>
						<input type="password" name="apassword" id="apassword" class="form-control" placeholder="Enter Password" value="<?php echo set_value('apassword',$apassword);?>"  required focus>
					</div>
					 
					 
					<div class="form-group has-feedback">
						<?php echo form_error('acpassword' ,'<div class="text-error">','</div>'); ?>
						<input type="password" name="acpassword" id="acpassword" class="form-control" placeholder="Enter Confirm Password" value="<?php echo set_value('acpassword',$acpassword);?>" required focus>
					</div>
					
					<p class="login-box-msg"><strong>STUDENT'S INFO</strong></p>
				
					<div class="form-group has-feedback">
						<?php echo form_error('fname' ,'<div class="text-error">','</div>'); ?>
						<input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name"  value="<?php echo set_value('fname',$fname);?>" required autofocus>
					</div>
					<div class="form-group has-feedback">
						<?php echo form_error('lname' ,'<div class="text-error">','</div>'); ?>
						<input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Last Name"  value="<?php echo set_value('lname',$lname);?>" required autofocus>
					</div>
					
					<div class="form-group has-feedback">
						<input type="text" class="form-control" id="datepicker" name="adate" placeholder="Enter Birth Date" value="<?php echo set_value('adate',$adate);?>" required autofocus>	
					</div>
					
					
					<div class="row form-group has-feedback">
						<div class="col-lg-8">
							<div class="radio">
								<input type="radio" name="radioOptions" id="radioOptions1" value="m" /> Male <input type="radio" name="radioOptions" id="radioOptions2" value="f" /> Female
							</div>
						</div>
					</div>
					
					<div class="row form-group has-feedback">
						<div class="col-lg-8">
							<div class="checkbox icheck">
								<label>
								  <input type="checkbox" name="acheckbox" id="acheckbox"> I accept terms & conditions of <a href="#">MUSIC TEACHER'S WORLD</a>
								</label>
							</div>		
						</div>
					</div>
					
					
                    <!--<div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>-->
                </div>
                <div class="footer">                                                               
                    
					<div class="row">
						<div class="col-lg-6">
							<input type="submit" name="login_user" value="Enroll" class="btn btn-primary btn-block btn-flat" />	
						</div>
						<div class="col-lg-6">
							<a href="<?php echo base_url().'student/';?>" class="btn btn-primary btn-block btn-flat">Cancel</a>
						</div>
					</div>
                    
                    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->
                </div>
            <?php echo form_close();?>

           <!-- <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>-->
			</div>
        </div>


        <!-- jQuery 2.0.2 -->
           
		
    </body>
</html>