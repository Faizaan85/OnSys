<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function checkLogin(){
			$emailId = $this->input->post('login_identity');
			$passWord = $this->input->post('login_password');
			$this->db->select('tblAdmin.*');
			$this->db->from('tblAdmin');
			$this->db->where('admEmailId',$emailId);
			$this->db->where('admPassword',md5($passWord));
			$query = $this->db->get();
			$result = $query->row_array();
			
			if(!empty($result)){
				$data_array = array(
							'admLastLoginTime' => date('Y-m-d H:i:s')
						   );
				$this->db->where('admId',$result['admId']);
				$this->db->update('tblAdmin',$data_array);
			}
		
			return $result;

    }
	
	public function getAllAdmin($filter_name, $sort, $order,$limit = '' , $start = ''){
		
		$order = ($order == 'desc') ? 'desc' : 'asc';
		$this->db->select('tblAdmin.*');
		$this->db->from('tblAdmin');
		if($start == 1)
		{
			$start = $start - 1;
		}
		$this->db->where('admRole !=','superadmin');
		$this->db->limit($limit,$start);
		
		if($filter_name != "")
		{
			$this->db->like('admFirstName', $filter_name); 
		}
		
		
		$this->db->order_by($sort,$order); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		$ret['rows'] = $query->result_array();
		
		$this->db->select('tblAdmin.*');
		$this->db->from('tblAdmin');
		$this->db->where('admRole !=','superadmin');	
		if($filter_name != "")
		{
			$this->db->like('admFirstName', $filter_name); 
		}
		
		$this->db->order_by($sort,$order); 
		$query = $this->db->get(); 
		
		$rows_count = $query->result_array();
		$ret['count'] =  sizeof($rows_count);
		
		return $ret;
		
		
	}
	
	public function insertAdmin(){
		$data_array = array(
								'admRole' => strtoupper($this->input->post('arole')),
								'admEmailId' => strtoupper($this->input->post('aemail')),
								'admPassword' => md5($this->input->post('apassword')),
								'admFirstName' => strtoupper($this->input->post('fname')),
								'admLastName' => strtoupper($this->input->post('lname')),
								'admIsActive' => strtoupper($this->input->post('astatus')),
								'admDateCreated' => date('Y-m-d H:i:s')
						   );
		
		$this->db->insert('tblAdmin',$data_array);
		
		$userId = $this->db->insert_id();
		
		if($userId>0){
			
			/*
			$to = $this->input->post('aemail');
			$from = 'chiragadhvaryu25@gmail.com';
			$subject = "Registration Successfully";
			$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			 <head>
			  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			  <title>Email Verification</title>
			  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			</head>
			<body>
			<table align="center" cellpadding="0" cellspacing="0" width="600" border="1">
			   <tr>
				  <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;border:0">
					 <table border="0" cellpadding="0" cellspacing="0" width="100%">
					  <tr>
					   <td style="font-size: 20px;line-height: 24px;font-weight: bold;color: #153643;font-family:Arial, sans-serif;padding-bottom:10px;">
					   Hello '.$this->input->post('fname').' '.$this->input->post('lname').',
					   </td>
					  </tr>
					  <tr>
					   <td style="font-size: 18px;line-height: 22px;color: #2e8b3d;font-family:Arial, sans-serif;padding:0 0 20px 38px;">
						Thank YOu For Register.
					   </td>
					  </tr>
					  <tr>
					   <td style="font-size: 18px;line-height: 22px;color: #2e8b3d;font-family:Arial, sans-serif;padding:0 0 20px 38px;">
						Name => '.$this->input->post('fname').' '.$this->input->post('lname').',
					   </td>
					  </tr>
					  <tr>
					   <td style="font-size: 18px;line-height: 22px;color: #2e8b3d;font-family:Arial, sans-serif;padding:0 0 20px 38px;">
						EmailId => '.$this->input->post('aemail').',
					   </td>
					  </tr>
					  <tr>
					   <td style="font-size: 18px;line-height: 22px;color: #2e8b3d;font-family:Arial, sans-serif;padding:0 0 20px 38px;">
						Password => '.$this->input->post('apassword').',
					   </td>
					  </tr>
					  <tr>
					   <td style="font-size: 18px;line-height: 22px;color: #2e8b3d;font-family:Arial, sans-serif;padding:0 0 20px 38px;">
						Activation Link => <a href="base_url().user/verifyCode/".$email_Verification_Code">Activate Your Account</a>,
					   </td>
					  </tr>
					  <tr>
					   <td style="font-size: 16px;line-height: 24px;color: #5c5c5c;font-family:Arial, sans-serif;padding:0 0 5px 38px;">
						 Thanks,<br/>
						 365 TEAM
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
			
			mail($to,$subject,$message,$headers);*/
			
		}
		
		
	}
	
	public function updateAdmin($admin_id){
		
		$data_array = array(
								'admRole' => strtoupper($this->input->post('arole')),
								'admEmailId' => strtoupper($this->input->post('aemail')),
								'admFirstName' => strtoupper($this->input->post('fname')),
								'admLastName' => strtoupper($this->input->post('lname')),
								'admIsActive' => strtoupper($this->input->post('astatus')),
						   );
		
		$this->db->where('admId',$admin_id);
		$this->db->update('tblAdmin',$data_array);
		
	}
	
	public function checkEmailForget($emailId){
		$this->db->select('tblAdmin.*');
		$this->db->from('tblAdmin');
		$this->db->where('tblAdmin.admEmailId',$emailId);
		$this->db->where('tblAdmin.admRole','superadmin');
		$fetchStatus=$this->db->get();
		if($fetchStatus->num_rows()==1){
			return 1;
		}else{
			return 0;
		}
	}
	
	public function addNewPassword($emailId,$password){
		$data = array(
						'admPassword' => md5($password)
					);
		
		$this->db->where('admEmailId',$emailId);
		$this->db->update('tblAdmin',$data);
	}
	
	public function getAdminDetail($adminId){
		$this->db->select('tblAdmin.*');
		$this->db->from('tblAdmin');
		$this->db->where('tblAdmin.admId',$adminId);
		$fetchStatus=$this->db->get();
		if($fetchStatus->num_rows()>0){
		
			return $fetchStatus->row_array();
			
		}else{
			
			return 0;
			
		}
	}
	
	public function checkEmailExist($email){
		$this->db->select('tblAdmin.*');
		$this->db->from('tblAdmin');
		$this->db->where('tblAdmin.admEmailId',$email);
		$fetchStatus=$this->db->get();
		return $fetchStatus->num_rows();
	}
	
	public function checkEmailExistUser($email){
		$this->db->select('tblUser.*');
		$this->db->from('tblUser');
		$this->db->where('tblUser.usrEmailId',$email);
		$fetchStatus=$this->db->get();
		return $fetchStatus->num_rows();
	}
	
	function fetchAdminActiveId($pk_i_id)
	{
		$this->db->select('tblAdmin.admIsActive');
		$this->db->from('tblAdmin');
		$this->db->where('tblAdmin.admId',$pk_i_id);
		$fetchStatus=$this->db->get();
		return $fetchStatus->row();
	}
	function activeAdminChange($id,$active)
	{
		if($active==1)
		{
			$active=0;
			$data = array(
							'admIsActive' => $active
						  );
			$this->db->where('tblAdmin.admId',$id);
			$this->db->update('tblAdmin',$data);
		}
		else
		{
			$active=1;
			$data = array(
							'admIsActive' => $active
						  );
			$this->db->where('tblAdmin.admId',$id);
			$this->db->update('tblAdmin',$data);
		}
	}
	
	
	
}
?>
