<style>
.text-error
{
	 color: #b94a48;
}
</style>
<?php
$this->load->view("common/header.php");
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<!-- Left side column. contains the logo and sidebar -->
<?php
$this->load->view("common/leftbar.php");
?>
<aside class="right-side">
           <!-- Content Header (Page header) -->
               <section class="content-header">
                </section>

				<section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                             <h2 class="page-header" align="right">                             	
                                    <a href="<?php echo base_url();?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i></a>
                             </h2>
                             
                            <div class="box box-primary">
                                
                               
					
								   <h1 style="color:red"><?php echo $errorMessage; ?></h1>
								  
							  
                                
                            </div><!-- /.box -->

                        </div><!--/.col (left) -->
                        <!-- right column -->
                        
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
        </aside>
            
<!-- /.right-side -->
</div><!-- ./wrapper -->
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
			acountry: "required",
			astatus: "required"
		},
		messages:
		{
		    fname:"<div class='text-error'>Please Enter First Name</div>",
			lname:"<div class='text-error'>Please Enter Last Name</div>",
			aemail:"<div class='text-error'>Please Enter Valid Email Address</div>",
			apassword:"<div class='text-error'>Please Enter Password</div>",
			acpassword:"<div class='text-error'>Please Enter Correct Password</div>",
			acountry:"<div class='text-error'>Please Select Country Box </div>",
			astatus:"<div class='text-error'>Please Select Admin Statu </div>"
		}
	});
});
</script>