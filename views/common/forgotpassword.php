<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Music Teacher | Activate Code</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url() ?>assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>     
        <script type="text/javascript" language="javascript">
		$(document).ready(function()
		{
				$("#lgnForm").validate(
				{
					rules:
					{
							forgetEmail:
							{
								required: true,
								email: true
							}
					},
					messages:
					{
							forgetEmail:"<div>Please Enter a Valid E-mail Address</div>",
					}
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
				<a href="<?php echo base_url();?>"><b>Music</b>Teacher</a>
		    </div>
        	<div class="login-box-body"> 
            <p class="login-box-msg"><b>Forgot Password</b></p>
            <?php echo form_open(base_url().'music/forgetPassword','id="lgnForm"');?> 
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
				
                    <div class="form-group has-feedback"><?php echo form_error('forgetEmail' ,'<div class="text-danger">','</div>'); ?>
                        <input type="email" class="form-control"  id="forgetEmail" name="forgetEmail" placeholder="EmailId"  required autofocus/>
                    </div>
					
                    <!--<div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>-->
                </div>
                <div class="footer">                                                               
                    
                    <input type="submit" name="login_user" value="Send" class="btn btn-primary btn-block btn-flat" />
                    <a href="<?php echo base_url().'student/';?>" class="btn btn-primary btn-block btn-flat">Login</a>
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