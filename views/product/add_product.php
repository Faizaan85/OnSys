<style>
.text-error
{
	 color: #b94a48;
}
.error{
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
						if(!empty($product_id)){
					    ?>
						Edit Product
						<?php
						}else{
					    ?>
						Add Product
						<?php
						}
						?>
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php
						if(!empty($product_id)){
					    ?>
						Edit Product
						<?php
						}else{
					    ?>
						Add Product
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
                                    <a href="<?php echo base_url().'product/manageProduct/?page='.$page?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i></a>
                                    <?php
								}
								else
								{
									?>
                                    <a href="<?php echo base_url().'product/manageProduct'?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i></a>
                                    <?php
								}
								?>
                             </h2>
                             
                            <div class="box box-primary">
                                
                                <!-- form start -->
                                <form role="form" name="frm" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post" action="<?php echo current_url().$url?>">
                                	<div class="box-body">
                                             <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Product Code:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('pcode' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="pcode" id="pcode" class="form-control" placeholder="Enter Product Code" style="text-transform:uppercase"  value="<?php echo set_value('pcode',$pcode);?>" <?php if($pcode!='' && $product_id!=''){ ?> readonly="readonly" <?php } ?> autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Product Type:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('pname' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="pname" id="pname" class="form-control" placeholder="Enter Company Name" style="text-transform:uppercase" value="<?php echo set_value('pname',$pname);?>" autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Product Description:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('pdescription' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
													   <textarea name="pdescription" style="text-transform:uppercase" id="pdescription" class="form-control" cols="53" rows="6" placeholder="Enter Product Description"><?php echo set_value('pdescription',$pdescription);?></textarea>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">From Year:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('pfyear' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="number" name="pfyear" id="pfyear" class="form-control" placeholder="Enter Product From Year" style="text-transform:uppercase" max="9999"  value="<?php echo set_value('pfyear',$pfyear);?>"  autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">To Year:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('ptyear' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="number" name="ptyear" id="ptyear" class="form-control" placeholder="Enter Product To Year" style="text-transform:uppercase" max="9999"  value="<?php echo set_value('ptyear',$ptyear);?>"  autofocus>
                                                 </div>
                                             </div>
											 <div class="row">
												  <div class="form-group col-md-12">
													  <label for="exampleInputEmail1" class="col-sm-3 control-label">Supplier Name</label>
													  <div class="col-sm-4">
															<input type="hidden" class="bigdrop" name="user_id" id="usersearch" style="width:260px" value="<?PHP echo $user_id;?>" autofocus />
													  </div>
												  </div>
											 </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Supplier Code:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('scode' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="scode" id="pname" class="form-control" placeholder="Enter Supplier Code" style="text-transform:uppercase" value="<?php echo set_value('scode',$scode);?>" autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Product OEM Code:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('poemcode' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="poemcode" id="poemcode" class="form-control" placeholder="Enter Product OEM Code" style="text-transform:uppercase" value="<?php echo set_value('poemcode',$poemcode);?>" autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Product Remark:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('premark' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="premark" id="premark" style="text-transform:uppercase" class="form-control" placeholder="Enter Product Remark"  value="<?php echo set_value('premark',$premark);?>" autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Product Measure:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('pmeasure' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="pmeasure" id="pmeasure" class="form-control" placeholder="Enter Product Measure" style="text-transform:uppercase"  value="<?php echo set_value('pmeasure',$pmeasure);?>" autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Product Unit Measurement:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('pumeasure' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <select name="pumeasure" id="pumeasure" class="form-control">
													   <option value="PCS">PCS</option>
													   <option value="SET" <?php if($pumeasure=='SET'){ ?> selected <?php } ?>>SET</option>
													   <option value="PRS" <?php if($pumeasure=='PRS'){ ?> selected <?php } ?>>PRS</option>
													</select>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Product Quantity:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('pquantity' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="pquantity" id="pquantity" class="form-control" placeholder="Enter Product Quantity" style="text-transform:uppercase" value="<?php echo set_value('pquantity',$pquantity);?>" autofocus>
                                                 </div>
                                             </div>
											 
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Product Min Level:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('pmnlevel' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="pmnlevel" id="pmnlevel" class="form-control" placeholder="Enter Product Min. Level" style="text-transform:uppercase"  value="<?php echo set_value('pmnlevel',$pmnlevel);?>"  autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Product Max Level:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('pmxlevel' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="pmxlevel" id="pmxlevel" class="form-control" placeholder="Enter Product Max. Level" style="text-transform:uppercase"  value="<?php echo set_value('pmxlevel',$pmxlevel);?>"  autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Product Unit Cost:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('pucost' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="pucost" id="pucost" class="form-control" placeholder="Enter Product Unit Cost" style="text-transform:uppercase"  value="<?php echo set_value('pucost',$pucost);?>"  autofocus>
                                                 </div>
                                             </div>
											 <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Product Sales Price:<span class="text-error"><b>*</b></span></label>
                                                 <?php echo form_error('pscost' ,'<div class="text-error">','</div>'); ?>
                                                 <div class="col-sm-4">
                                                    <input type="text" name="pscost" id="pscost" class="form-control" placeholder="Enter Product Sales Price" style="text-transform:uppercase"  value="<?php echo set_value('pscost',$pscost);?>"  autofocus>
                                                 </div>
                                             </div>
											
											
											
                                            <div class="box-footer">
												  <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id;?>" />
                                                  <input type="submit" name="save" id="save" value="Save" class="btn btn-primary">
												  <a href="<?php echo base_url().'product/manageProduct'?>" class="btn btn-primary">Cancel</a>
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
function format(results) 
{
	return  " <strong>" + results.code + "</strong>";
}
function formatSelect(results) {
	return  " <strong>" + results.code + "</strong>";
}

$('#usersearch').select2({
			placeholder: 'Search For a Supplier',
			closeOnSelect: true,
			minimumInputLength: 1,
			formatResult: format,
			formatSelection: formatSelect,
			ajax: {
                    url: "<?php echo base_url() ?>product/getMemberByAjax",
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
				return $.getJSON("<?php echo base_url() ?>product/getMemberByAjax/" + (element.val()), null, function(data) {
						//alert(data.results[0].id);
						return callback(data.results[0]);
				});
			},
});
</script>