<aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url(); ?>assets/img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello,<?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name');?></p> 

                            <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
                        </div>
                    </div>
                    
                    <!-- sidebar menu: : style can be found in sidebar.less  fa-list-ul -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa  fa-user"></i>
                                <span>Admin Management</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                              <li><a href="<?php echo base_url()?>admin/manageAdmin"><i class="fa fa-angle-double-right"></i>Manage Admin Accounts</a></li>
                     		</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa  fa-users"></i>
								<span>Customer Management</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
							  <li><a href="<?php echo base_url()?>customer/manageCustomer"><i class="fa fa-angle-double-right"></i>Manage Customer Account</a></li>
							  
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa  fa-users"></i>
								<span>Supplier Management</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
							  <li><a href="<?php echo base_url()?>supplier/manageSupplier"><i class="fa fa-angle-double-right"></i>Manage Supplier Account</a></li>
							  
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-fw fa-gears"></i>
								<span>Product Management</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
							  <li><a href="<?php echo base_url()?>product/manageProduct"><i class="fa fa-angle-double-right"></i>Manage Product</a></li>
							  
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-fw fa-clone"></i>
								<span>Quotation Management</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
							  <li><a href="<?php echo base_url()?>quotation/addQuotation"><i class="fa fa-angle-double-right"></i>Create Quotation</a></li>
							  <li><a href="<?php echo base_url()?>quotation/manageQuotation"><i class="fa fa-angle-double-right"></i>Manage Quotation</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-fw fa-check-square"></i>
								<span>PDC Management</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
							  <li><a href="<?php echo base_url()?>pdc/managePDC"><i class="fa fa-angle-double-right"></i>Manage PDC</a></li>
							</ul>
						</li>
						<!--<li class="treeview">
                            <a href="#">
                                <i class="fa  fa-user"></i>
                                <span>Business Owner Management</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                              <li><a href="<?php echo base_url()?>businessuser/manageBusinessUser"><i class="fa fa-angle-double-right"></i>Manage Business User Accounts</a></li>
                     		</ul>
						</li>-->
						
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>