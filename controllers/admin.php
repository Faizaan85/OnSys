<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->helper('url');
		$this->load->model("admin_model");     
	}
	
	public function index()
	{
		$value = $this->session->userdata('user_id');
		if(!empty($value)){
			$this->load->view('dashboard');
		}
		else{
			$this->load->view('common/login');
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata('message','You are successfully logout.');
		redirect('admin');
	}
	
	public function forgetPassword(){
		
		$this->form_validation->set_rules('forgetEmail','Email','required|valid_email|xss_clean');
		
		$checkEmail = $this->admin_model->checkEmailForget($this->input->post('forgetEmail'));
		
		if($_POST){
				if($checkEmail==1){
					
					$emailId = $this->input->post('forgetEmail');
					$forgetPassword = randomCodePassword();
					$this->admin_model->addNewPassword($this->input->post('forgetEmail'),$forgetPassword);
					
					
					$to = $emailId;
					$from = 'info@the-365.com';
					$subject = "Email Notification for New Password ";
					$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					 <head>
					  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					  <title>Alshrouqu Express system</title>
					  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
					</head>
					<body>
					<table align="center" cellpadding="0" cellspacing="0" width="600" border="1">
					   <tr>
						  <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;border:0">
							 <table border="0" cellpadding="0" cellspacing="0" width="100%">
							  <tr>
							   <td style="font-size: 20px;line-height: 24px;font-weight: bold;color: #153643;font-family:Arial, sans-serif;padding-bottom:10px;">
							   Hello user,
							   </td>
							  </tr>
							  <tr>
							   <td style="font-size: 18px;line-height: 22px;color: #2e8b3d;font-family:Arial, sans-serif;padding:0 0 20px 38px;">
								Use this verification code to reset password.
							   </td>
							  </tr>
							  <tr>
							   <td style="font-size: 16px;line-height: 24px;color: #5c5c5c;font-family:Arial, sans-serif;padding:0 0 5px 38px;">
								 New Password  :  <span style="color: #5c5c5c;">' . $randomPassword . '</span>
							   </td>
							  </tr>
							 </table>
							</td>
						 </tr>
						 <tr>
						   <td bgcolor="#333" style="padding: 10px 30px 10px 30px;font-size: 16px;line-height: 24px;color: #fff;font-family:Arial, sans-serif;text-align:center;border:0"></td>
						</tr>
					</table>
					</body>
					</html>';
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers .= 'From: ' . $from . "\r\n";
					
					mail($to,$subject,$message,$headers);
					
					$this->session->set_flashdata('message','You Password successfully changed.');
					redirect('admin','refresh');
					
				}
		}
		
		
		$data['forgetEmail'] = $this->form_validation->set_value('forgetEmail');
		
		$this->load->view('common/forgetPassword',$data);
	}
	
	
	
	public function checkLogin(){
		$this->form_validation->set_rules('login_identity','Email','required|valid_email|xss_clean');
		$this->form_validation->set_rules('login_password','Password','required|xss_clean');
		if($this->form_validation->run() == true)
		{
			$record = $this->admin_model->checkLogin();
			if(!empty($record)){

				$data = array(
						'user_id' => $record['admId'],
						'email' => $record['admEmailId'],
						'first_name' => $record['admFirstName'],
						'last_name' => $record['admLastName'],
						'admin_role_name' => $record['admRole']
					     );	
				$this->session->set_userdata($data);
				redirect('admin/dashboard');
			}
			else{
				$this->session->set_flashdata('errormessage','Please Enter Proper EmailId Or Password.');
				redirect('admin/');
			}
			
		}
		
		$data['login_identity'] = $this->form_validation->set_value('login_identity');
		$data['login_password'] = $this->form_validation->set_value('login_password');
		$this->load->view('common/login',$data);
	}
	
	public function checkEmailExist($aemail){
		
		$checkCodeExist = $this->admin_model->checkEmailExist($aemail);
		
		if($checkCodeExist>0){
			$this->form_validation->set_message('checkEmailExist', 'Please Enter Unique EmailId');
			return false;
		}else{
			return true;
		}
	}
	
	
	public function checkEmailExistUser($aemail){
		$checkCodeExist = $this->admin_model->checkEmailExistUser($aemail);
		
		if($checkCodeExist>0){
			$this->form_validation->set_message('checkEmailExistUser', 'Please Enter Unique EmailId');
			return false;
		}else{
			return true;
		}
	}
	
	
	public function dashboard(){
		$value = $this->session->userdata('user_id');
		if($value==""){
			redirect('admin','refresh');
		}
		$this->load->view('dashboard');
	}
	
	public function deleteAdmin(){
		if (isset($this->request->get['filter_name'])) 
		{
			$filter_name = $this->request->get['filter_name'];
		}
		else if (isset($this->request->post['filter_name'])) 
		{
			$filter_name = $this->request->post['filter_name'];
		}
		else 
		{
			$filter_name = "";
		}
		
		if(isset($this->request->get['sort'])) 
		{
			$sort = $this->request->get['sort'];
		} 
		else
		{
			$sort = 'tblAdmin.admId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'asc';
		}	
		
		if(isset($this->request->get['admin_id'])) {
			$id = $this->request->get['admin_id'];
		}
		else
		{
			$id = "";
		}
		
		if(isset($this->request->get['status'])) {
			$sts = $this->request->get['status'];
		}
		else
		{
			$sts = "";
		}
		
		if(isset($this->request->get['order_url'])) {
			$order_url = $this->request->get['order_url'];
		}
		else 
		{
			$order_url = "";
		}
		
		if (isset($this->request->get['delete_url'])) 
		{
			$delete_url = $this->request->get['delete_url'];
		}
		else if (isset($this->request->post['delete_url'])) 
		{
			$delete_url = $this->request->post['delete_url'];
		}
		else 
		{
			$delete_url = "";
		}
		
		if(isset($this->request->get['page']))
		{
			$page = $this->request->get['page'];
		} 
		else 
		{
			$page = 1;
		}
		
		$url = '?';
		
		if(isset($this->request->get['filter_name']) || isset($this->request->post['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($filter_name, ENT_QUOTES, 'UTF-8'));
		}
		if(isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if(isset($this->request->get['order'])) {
			$url .= '&order=' .$this->request->get['order'];
		}
		if(isset($this->request->get['admin_id'])) {
			$url .= '&admin_id=' .$this->request->get['admin_id'];
		}
		if(isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if(isset($this->request->get['status'])) {
			$url .= '&status=' . $this->request->get['status'];
		}
		if(isset($this->request->get['order_url'])) {
			$url .= '&order_url=' .$this->request->get['order_url'];
		}
		if(isset($this->request->get['delete_url'])) {
			$url .= '&delete_url=' . $this->request->get['delete_url'];
		}
		
		$data['url'] = $url;
		$data['page'] = $page;
		
		$this->db->where('admId',$id);
		$this->db->delete('tblAdmin');
		$this->session->set_flashdata('message','<strong>Admin Record Deleted Successfully</strong>');
		redirect('admin/manageAdmin','refresh');
	}
	
	public function editAdmin(){
		if (isset($this->request->get['filter_name'])) 
		{
			$filter_name = $this->request->get['filter_name'];
		}
		else if (isset($this->request->post['filter_name'])) 
		{
			$filter_name = $this->request->post['filter_name'];
		}
		else 
		{
			$filter_name = "";
		}
		
		if(isset($this->request->get['sort'])) 
		{
			$sort = $this->request->get['sort'];
		} 
		else
		{
			$sort = 'tblAdmin.admId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'asc';
		}	
		
		if(isset($this->request->get['admin_id'])) {
			$id = $this->request->get['admin_id'];
		}
		else
		{
			$id = "";
		}
		
		if(isset($this->request->get['status'])) {
			$sts = $this->request->get['status'];
		}
		else
		{
			$sts = "";
		}
		
		if(isset($this->request->get['order_url'])) {
			$order_url = $this->request->get['order_url'];
		}
		else 
		{
			$order_url = "";
		}
		
		if (isset($this->request->get['delete_url'])) 
		{
			$delete_url = $this->request->get['delete_url'];
		}
		else if (isset($this->request->post['delete_url'])) 
		{
			$delete_url = $this->request->post['delete_url'];
		}
		else 
		{
			$delete_url = "";
		}
		
		if(isset($this->request->get['page']))
		{
			$page = $this->request->get['page'];
		} 
		else 
		{
			$page = 1;
		}
		
		$url = '?';
		
		if(isset($this->request->get['filter_name']) || isset($this->request->post['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($filter_name, ENT_QUOTES, 'UTF-8'));
		}
		if(isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if(isset($this->request->get['order'])) {
			$url .= '&order=' .$this->request->get['order'];
		}
		if(isset($this->request->get['admin_id'])) {
			$url .= '&admin_id=' .$this->request->get['admin_id'];
		}
		if(isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if(isset($this->request->get['status'])) {
			$url .= '&status=' . $this->request->get['status'];
		}
		if(isset($this->request->get['order_url'])) {
			$url .= '&order_url=' .$this->request->get['order_url'];
		}
		if(isset($this->request->get['delete_url'])) {
			$url .= '&delete_url=' . $this->request->get['delete_url'];
		}
		
		
		
		$this->form_validation->set_rules('fname','First Name','required|xss_clean');
		$this->form_validation->set_rules('lname','Last Name','required||xss_clean');
		$this->form_validation->set_rules('apassword','Admin Password','required|xss_clean');
		$this->form_validation->set_rules('aemail','Admin Email','required|valid_email|xss_clean');
		$this->form_validation->set_rules('arole','Admin Role','required|xss_clean');
		$this->form_validation->set_rules('astatus','Admin Status','required|xss_clean');
		
		$data['admin_info'] = $adminInfo = $this->admin_model->getAdminDetail($id);
		
		if($this->form_validation->run() == true)
		{
			$admin_id = $this->input->post('admin_id');
			$this->admin_model->updateAdmin($admin_id);
			$this->session->set_flashdata('message','<strong>Admin Record Updated Successfully</strong>');
			redirect('admin/manageAdmin');
		}
		
		if($adminInfo==0){
			
			$data['errorMessage'] = 'No Record Found';
		
			$this->load->view('common/404',$data);
			
		}else{
			
			$data['url'] = $url;
			$data['page'] = $page;
			$data['admin_id'] = $adminInfo['admId'];
			
			$data['fname'] = $adminInfo['admFirstName'];
			$data['lname'] = $adminInfo['admLastName'];
			$data['arole'] = $adminInfo['admRole'];
			$data['apassword'] = $adminInfo['admPassword'];
			$data['acpassword'] = $adminInfo['admPassword'];
			$data['aemail'] = $adminInfo['admEmailId'];
			$data['astatus'] = $adminInfo['admIsActive'];
			
			$this->load->view('admin/add_admin',$data);
			
		}
		
		
		
		
		
	}
	
	
	public function addAdmin(){
		
		if (isset($this->request->get['filter_name'])) 
		{
			$filter_name = $this->request->get['filter_name'];
		}
		else if (isset($this->request->post['filter_name'])) 
		{
			$filter_name = $this->request->post['filter_name'];
		}
		else 
		{
			$filter_name = "";
		}
		
		if(isset($this->request->get['sort'])) 
		{
			$sort = $this->request->get['sort'];
		} 
		else
		{
			$sort = 'tblAdmin.admId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'asc';
		}	
		
		if(isset($this->request->get['admin_id'])) {
			$id = $this->request->get['admin_id'];
		}
		else
		{
			$id = "";
		}
		
		if(isset($this->request->get['status'])) {
			$sts = $this->request->get['status'];
		}
		else
		{
			$sts = "";
		}
		
		if(isset($this->request->get['order_url'])) {
			$order_url = $this->request->get['order_url'];
		}
		else 
		{
			$order_url = "";
		}
		
		if (isset($this->request->get['delete_url'])) 
		{
			$delete_url = $this->request->get['delete_url'];
		}
		else if (isset($this->request->post['delete_url'])) 
		{
			$delete_url = $this->request->post['delete_url'];
		}
		else 
		{
			$delete_url = "";
		}
		
		if(isset($this->request->get['page']))
		{
			$page = $this->request->get['page'];
		} 
		else 
		{
			$page = 1;
		}
		
		$url = '?';
		
		if(isset($this->request->get['filter_name']) || isset($this->request->post['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($filter_name, ENT_QUOTES, 'UTF-8'));
		}
		if(isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if(isset($this->request->get['order'])) {
			$url .= '&order=' .$this->request->get['order'];
		}
		if(isset($this->request->get['admin_id'])) {
			$url .= '&admin_id=' .$this->request->get['admin_id'];
		}
		if(isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if(isset($this->request->get['status'])) {
			$url .= '&status=' . $this->request->get['status'];
		}
		if(isset($this->request->get['order_url'])) {
			$url .= '&order_url=' .$this->request->get['order_url'];
		}
		if(isset($this->request->get['delete_url'])) {
			$url .= '&delete_url=' . $this->request->get['delete_url'];
		}
		
		
		
		$this->form_validation->set_rules('fname','First Name','required|xss_clean');
		$this->form_validation->set_rules('lname','Last Name','required||xss_clean');
		$this->form_validation->set_rules('apassword','Admin Password','required|xss_clean');
		$this->form_validation->set_rules('arole','Admin Role','required');
		$this->form_validation->set_rules('aemail','Admin Email','required|valid_email|callback_checkEmailExist|xss_clean');
		$this->form_validation->set_rules('astatus','Admin Status','required');
		
		if($this->form_validation->run() == true)
		{
			$this->admin_model->insertAdmin();
			$this->session->set_flashdata('message','<strong>Admin Record Inserted Successfully</strong>');
			redirect('admin/manageAdmin');
		}
		
		$data['url'] = $url;
		$data['page'] = $page;
		$data['admin_id'] = $id;
		
		$data['fname'] = $this->form_validation->set_value('fname');
		$data['lname'] = $this->form_validation->set_value('lname');
		$data['apassword'] = $this->form_validation->set_value('apassword');
		$data['acpassword'] = $this->form_validation->set_value('apassword');
		$data['aemail'] = $this->form_validation->set_value('aemail');
		$data['arole'] = $this->form_validation->set_value('arole');
		$data['astatus'] = $this->input->post('astatus');
		
		$this->load->view('admin/add_admin',$data);
		
	}
	
	public function manageAdmin(){
		
		if (isset($this->request->get['filter_name'])) 
		{
			$filter_name = $this->request->get['filter_name'];
		}
		else if (isset($this->request->post['filter_name'])) 
		{
			$filter_name = $this->request->post['filter_name'];
		}
		else 
		{
			$filter_name = "";
		}
		
		if(isset($this->request->get['sort'])) 
		{
			$sort = $this->request->get['sort'];
		} 
		else
		{
			$sort = 'tblAdmin.admId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'desc';
		}	
		
		if(isset($this->request->get['admin_id'])) {
			$id = $this->request->get['admin_id'];
		}
		else
		{
			$id = "";
		}
		
		if(isset($this->request->get['status'])) {
			$sts = $this->request->get['status'];
		}
		else
		{
			$sts = "";
		}
		
		if(isset($this->request->get['order_url'])) {
			$order_url = $this->request->get['order_url'];
		}
		else 
		{
			$order_url = "";
		}
		
		if (isset($this->request->get['delete_url'])) 
		{
			$delete_url = $this->request->get['delete_url'];
		}
		else if (isset($this->request->post['delete_url'])) 
		{
			$delete_url = $this->request->post['delete_url'];
		}
		else 
		{
			$delete_url = "";
		}
		
		if(isset($this->request->get['page']))
		{
			$page = $this->request->get['page'];
		} 
		else 
		{
			$page = 1;
		}
		
		$url = '?';
		
		if(isset($this->request->get['filter_name']) || isset($this->request->post['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($filter_name, ENT_QUOTES, 'UTF-8'));
		}
		if(isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if(isset($this->request->get['order'])) {
			$url .= '&order=' .$this->request->get['order'];
		}
		if(isset($this->request->get['admin_id'])) {
			$url .= '&admin_id=' .$this->request->get['admin_id'];
		}
		if(isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if(isset($this->request->get['status'])) {
			$url .= '&status=' . $this->request->get['status'];
		}
		if(isset($this->request->get['order_url'])) {
			$url .= '&order_url=' .$this->request->get['order_url'];
		}
		if(isset($this->request->get['delete_url'])) {
			$url .= '&delete_url=' . $this->request->get['delete_url'];
		}
		
		$data['url'] = $url;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['admin_id'] = $id;	
		$data['status'] = $sts;
		$data['order_url'] = $order_url;
		$data['filter_name'] = $filter_name;
		
		if ($page < 1) 
		{
			$page = 1;
		}
		else
		{
			$page = $page;
		}
		
		$config = array();
		$config["per_page"] =  10;
		$results = $this->admin_model->getAllAdmin($filter_name, $sort, $order, $config["per_page"] , $page); 
		
		$config["base_url"] = site_url('admin/manageAdmin/'.$url);
		$config["total_rows"] = $results['count'];
		$config["uri_segment"] = 4;  
		$config['query_string_segment'] = 'page';
		$config['page_query_string'] = TRUE;
		$config['uri_protocol'] = "PATH_INFO";
		$this->pagination->initialize($config); 
		
		$data['total_count'] = $results['count'];
		
		
		if(count($results['rows']) == 0 &&  $page!=1)
		{
			$total = (int)$data['total_count'];
			$maxPage = ceil( $total / (int)$config["per_page"] );
			$url = base_url().'admin/manageAdmin/'.'?'.$_SERVER['QUERY_STRING'];

			if($maxPage==0) 
			{
				$url = preg_replace('/&page=(\d)+/', '&page=1', $url);
				redirect($url);
			}
			elseif($maxPage==1)
			{
				redirect(base_url().'admin/manageAdmin/?&page='.$maxPage);
			}
		}
		
		foreach($results['rows'] as $result) 
		{	
		  $data['results'][] = array('admin_id'	     => $result['admId'],
									 'admin_role'    => $result['admRole'],
									 'first_name'    => $result['admFirstName'],
									 'last_name'   	 => $result['admLastName'],
									 'emailId'   	 => $result['admEmailId'],
									 'admin_status'  => $result['admIsActive'],
									 'date_added'	 => convertDate($result['admDateCreated']),
									 'edit_url'      => base_url().'admin/editAdmin/'.$url.'&admin_id='.$result['admId'],
									 'delete_url'    => base_url().'admin/deleteAdmin/'.$url.'&admin_id='.$result['admId'],
									 'filter_name'  => base_url().'admin/manageAdmin/'.$url.'&filter_name='.$filter_name,
									 'order' => $order,
									 'page'	=>$page,
									 'sort'	=> $sort,
									 'filter_name' 	=> $filter_name,
								     );
	    }
		$data['page'] = $page;	
		$data['search_url'] = base_url().'admin/manageAdmin/?filter_='.(($order == 'asc') ? 'desc' : 'asc').'&sort='.$sort .'&page='.$page ;
		$data['order_url'] = base_url().'admin/manageAdmin/?order='.(($order == 'asc') ? 'desc' : 'asc').'&filter_name='.$filter_name.'&sort='.$sort.'&page='.$page ;
		
		$this->load->view('admin/manage_admin',$data);
		
		
	}
	
	public function activeAdminRecord()
	{ 	
			$pk_i_id = $this->request->get['category_id'];
			$data['fetch_status'] = $this->admin_model->fetchAdminActiveId($pk_i_id);
			$this->admin_model->activeAdminChange($pk_i_id,$data['fetch_status']->admIsActive);
			$data['active'] = $this->admin_model->fetchAdminActiveId($pk_i_id);
			$json = array();
  			$json['success'] = true;
			$json['msg'] = "";
			if(($data['active']->admIsActive)==1)
			{
				$json['msg'] = "Active";
			}
			else
			{
				$json['msg'] = "In Active";
			}
			echo json_encode($json);
  			return false;
	}
	
	
}
?>