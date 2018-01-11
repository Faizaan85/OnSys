<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    public function getAllCustomers($filter_name, $sort, $order,$limit = '' , $start = ''){
		
		$order = ($order == 'desc') ? 'desc' : 'asc';
		$this->db->select('tblCustomerMaster.*');
		$this->db->from('tblCustomerMaster');
		$this->db->where('cstIsActive',1);
		$this->db->where('cstIsDelete',0);
		if($start == 1)
		{
			$start = $start - 1;
		}
		$this->db->limit($limit,$start);
		
		if($filter_name != "")
		{
			$this->db->like('cstCompanyName', $filter_name);
			$this->db->or_like('cstCode', $filter_name); 
		}
		
		
		$this->db->order_by($sort,$order); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		$ret['rows'] = $query->result_array();
		
		$this->db->select('tblCustomerMaster.*');
		$this->db->from('tblCustomerMaster');
		$this->db->where('cstIsActive',1);
		$this->db->where('cstIsDelete',0);
		if($filter_name != "")
		{
			$this->db->like('cstCompanyName', $filter_name);
			$this->db->or_like('cstCode', $filter_name); 
		}
		
		$this->db->order_by($sort,$order); 
		$query = $this->db->get(); 
		
		$rows_count = $query->result_array();
		$ret['count'] =  sizeof($rows_count);
		
		return $ret;
		
		
	}
	
	function updateCustomer(){
		
		$dataInsert = array(
								
								'cstCompanyName' => $this->input->post('cname'),
								'cstAddress' => $this->input->post('caddress'),
								'cstContactPerson' => $this->input->post('cperson'),
								'cstPhoneNumber1' => $this->input->post('cphone'),
								'cstPhoneNumber2' => $this->input->post('cphone1'),
								'cstMobileNumber1' => $this->input->post('cmobile'),
								'cstMobileNumber2' => $this->input->post('cmobile1'),
								'cstFaxNumber' => $this->input->post('cfax'),
								'cstBillType' => $this->input->post('cbilltype'),
								'cstIsActive' => $this->input->post('cstatus'),
								'cstDateModified' => date('Y-m-d')
						   );
		
		$this->db->where('cstId',$this->input->post('customer_id'));
		$this->db->update('tblCustomerMaster',$dataInsert);
		
	}
	
	public function getCustomerDetail($adminId){
		$this->db->select('tblCustomerMaster.*');
		$this->db->from('tblCustomerMaster');
		$this->db->where('tblCustomerMaster.cstId',$adminId);
		$fetchStatus=$this->db->get();
		if($fetchStatus->num_rows()>0){
		
			return $fetchStatus->row_array();
			
		}else{
			
			return 0;
			
		}
	}
	
	function insertCustomer(){
		
		if($this->input->post('cbalance')!=''){
			$balance = $this->input->post('cbalance');
		}else{
			$balance = 0;
		}
		
		$dataInsert = array(
								'cstCode' => $this->input->post('ccode'),
								'cstCompanyName' => $this->input->post('cname'),
								'cstEmailId' => $this->input->post('cemail'),
								'cstAddress' => $this->input->post('caddress'),
								'cstContactPerson' => $this->input->post('cperson'),
								'cstPhoneNumber1' => $this->input->post('cphone'),
								'cstPhoneNumber2' => $this->input->post('cphone1'),
								'cstMobileNumber1' => $this->input->post('cmobile'),
								'cstMobileNumber2' => $this->input->post('cmobile1'),
								'cstFaxNumber' => $this->input->post('cfax'),
								'cstBillType' => $this->input->post('cbilltype'),
								'cstCreditLimit' => $this->input->post('climit'),
								'cstCreditAvailable' => $this->input->post('climit'),
								'cstBalance' => $balance,
								'cstIsActive' => $this->input->post('cstatus'),
								'cstDateCreated' => date('Y-m-d')
						   );
		
		$this->db->insert('tblCustomerMaster',$dataInsert);
		
	}
	
	public function checkEmailExist($email){
		$this->db->select('tblCustomerMaster.*');
		$this->db->from('tblCustomerMaster');
		$this->db->where('tblCustomerMaster.cstEmailId',$email);
		$fetchStatus=$this->db->get();
		return $fetchStatus->num_rows();
	}
	
	public function checkCustomerCode($code){
		
		$this->db->select('tblCustomerMaster.*');
		$this->db->from('tblCustomerMaster');
		$this->db->where('tblCustomerMaster.cstCode',$code);
		$fetchStatus=$this->db->get();
		return $fetchStatus->num_rows();
		
	}
    
    function fetchCustomerActiveId($pk_i_id)
	{
		$this->db->select('tblCustomerMaster.cstIsActive');
		$this->db->from('tblCustomerMaster');
		$this->db->where('tblCustomerMaster.cstId',$pk_i_id);
		$fetchStatus=$this->db->get();
		return $fetchStatus->row();
	}
	function activeCustomerChange($id,$active)
	{
		if($active==1)
		{
			$active=0;
			$data = array(
							'cstIsActive' => $active
						  );
			$this->db->where('tblCustomerMaster.cstId',$id);
			$this->db->update('tblCustomerMaster',$data);
		}
		else
		{
			$active=1;
			$data = array(
							'cstIsActive' => $active
						  );
			$this->db->where('tblCustomerMaster.cstId',$id);
			$this->db->update('tblCustomerMaster',$data);
		}
	}
}
?>