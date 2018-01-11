<?php /*?><?php 
echo "<pre>";
print_r($this->session->all_userdata());
die;
?><?php */?>
<?php echo $this->load->view('common/header.php');?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php echo $this->load->view('common/leftbar.php');?>
<?php echo $this->load->view('common/content.php');?>
<?php echo $this->load->view('common/footer.php');?>
