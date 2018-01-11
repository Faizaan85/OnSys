<?php $this->load->view('common/header'); ?>
<!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('common/leftbar'); ?>
<!-- Right side column. Contains the navbar and content of the page -->
	
<!-- New Code -->

	<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Manage Admin
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Manage Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
              <section class="content">
                      <!-- left column -->
                      <?php if($this->session->flashdata('message'))
                        {
                  ?>
                  <div class="alert alert-success alert-dismissable">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <b><?php echo $this->session->flashdata('message')?></b>
                    </div>
                  <?php 
				  		$this->session->unset_userdata('flash:new:message');
                     	} ?>
                        <?php if($this->session->flashdata('message1'))
                        {
                  ?>
                  <div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <b><?php echo $this->session->flashdata('message1')?></b>
                    </div>
                  <?php 
				  		$this->session->unset_userdata('flash:new:message1');
                     	} ?>
					  <h2 class="page-header" align="right"><a href="<?php echo base_url().'admin/addAdmin' ?>" class="btn btn-success">Add Admin</a></h2>
                      <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                            <?php echo form_open(base_url().'admin/manageAdmin');	?>	
                                <div class="box-header">
                                    <h3 class="box-title">Manage Admin</h3>
                                    <div class="box-tools">
                                        <div class="input-group">
                                            <input type="text" name="filter_name" class="form-control input-sm pull-right" style="width: 200px;" placeholder="Search Admin" value="<?php echo $filter_name ?>" />
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover table-bordered table-striped">
                                        <tr>
                                            <th><a href="<?php echo $order_url; ?>">Admin Id</a></th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
											<th>Email Id</th>
											<th>Role Name</th>
											<th>Status</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                        </tr>
                                        
                                         <?php
										  //echo "<pre>";print_r($results);die;
										  if(! empty($results))
										  {
											  foreach($results as $player)
											  {
											  	?>
                                                <tr>
                                                    <td><?php echo $player['admin_id'] ?></td>
                                                    <td><?php echo $player['first_name'] ?></td>
                                                    <td><?php echo $player['last_name'] ?></td>
													<td><?php echo $player['emailId'] ?></td>
													<td><?php echo $player['admin_role'] ?></td>
													<td><a id="admin_<?php echo $player['admin_id']?>" class="btn btn-success" onClick="statusChange('<?php echo $player['admin_id']?>')"><?php if(($player['admin_status'])==1){echo "Active"; } else { echo "In Active";} ?></a></td>
													<td><?php echo $player['date_added']?></td>
                                                    <td><a href="<?php echo $player['edit_url']?>" class="btn btn-default btn-circle" id="update"><i class="fa fa-edit"></i></a> &nbsp; <a href="<?php echo $player['delete_url']?>" onClick="return confirm('Are you sure to Delete this Admin Record?');" class="btn btn-default btn-circle" id="delete"><i class="fa fa-times"></i></a></td>
  												</tr>
                                              <?php
											  }
										  } 
										  else
										  {
											  ?>
                                              <tr>
                                              	<td colspan="8"> Record Not Found ! </td>
                                              </tr>
                                              <?php
										  }
										 ?>
										 
                                            
                                    </table>
                                    <?php echo form_close(); ?>
                                </div><!-- /.box-body -->
                                 
                                <div class="box-footer clearfix">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <li><?php echo $this->pagination->create_links(); ?></li>
                                    </ul>
                                </div>
                                
                            </div><!-- /.box -->
                        </div>
                    </div>
              
              </section>
                <!-- /.content -->
            </aside>
<!-- /.right-side -->
</div><!-- ./wrapper -->
<!-- add new calendar event modal -->
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript" language="javascript">
function statusChange(pk_i_id)
{
	$.ajax(
	{
		type: "GET",
		url: '<?php echo base_url()?>admin/activeAdminRecord/?category_id='+pk_i_id,
		dataType : 'json',
		success: function(data)
		{
			$("a[id=admin_"+pk_i_id+"]").html(data.msg);
		}
	});
}
</script>